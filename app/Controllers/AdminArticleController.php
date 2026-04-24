<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;
use App\Models\TagModel;
use App\Helpers\SlugHelper;
use App\Helpers\ImageHelper;
use App\Middleware\AuthMiddleware;

class AdminArticleController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new ArticleModel();
        // Get all articles with tags grouped
        $stmt = \Core\Database::getInstance()->prepare(
            "SELECT a.*, u.name AS author_name, c.name_en AS category_name, m.path AS image_path,
                    GROUP_CONCAT(t.name SEPARATOR ', ') AS tag_list
             FROM articles a 
             LEFT JOIN users u ON a.author_id = u.id 
             LEFT JOIN categories c ON a.category_id = c.id 
             LEFT JOIN media m ON a.featured_image = m.id 
             LEFT JOIN article_tags at ON a.id = at.article_id
             LEFT JOIN tags t ON at.tag_id = t.id
             GROUP BY a.id
             ORDER BY a.created_at DESC LIMIT 100"
        );
        $stmt->execute();
        $articles = $stmt->fetchAll();
        
        $this->render('admin/articles/index', [
            'articles' => $articles,
            'title' => 'Manage Articles'
        ]);
    }

    public function create() {
        $catModel = new CategoryModel();
        $subModel = new SubcategoryModel();
        $tagModel = new TagModel();

        $this->render('admin/articles/create', [
            'title' => 'Write New Article',
            'categories' => $catModel->getAll(),
            'subcategories' => $subModel->getAll(),
            'tags' => $tagModel->getAll()
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleModel = new ArticleModel();
            
            $title = $_POST['title'] ?? '';
            if (mb_strlen($title) < 20) {
                die("Error: Article headline must be at least 20 characters long.");
            }

            $slug = !empty($_POST['slug']) ? SlugHelper::create($_POST['slug']) : SlugHelper::create($title);
            
            $featuredImageId = null;
            if (!empty($_FILES['image']['name'])) {
                try {
                    $uploadResult = ImageHelper::processUpload($_FILES['image']);
                    
                    // Save to media table
                    $db = \Core\Database::getInstance();
                    $stmt = $db->prepare("INSERT INTO media (path, type) VALUES (:path, 'image')");
                    $stmt->execute([':path' => $uploadResult['path']]);
                    $featuredImageId = $db->lastInsertId();
                } catch (\Exception $e) {
                    // Log error or show message
                }
            }

            $data = [
                ':title' => $title,
                ':slug' => $slug,
                ':body' => $_POST['body'] ?? '',
                ':excerpt' => $_POST['excerpt'] ?? '',
                ':author_id' => $_SESSION['admin_user']['id'],
                ':category_id' => $_POST['category_id'] ?? null,
                ':subcategory_id' => $_POST['subcategory_id'] ?: null,
                ':lang' => $_POST['lang'] ?? 'pa',
                ':status' => $_POST['status'] ?? 'draft',
                ':priority' => $_POST['priority'] ?? 'normal',
                ':featured_image' => $featuredImageId,
                ':seo_title' => $_POST['seo_title'] ?? $title,
                ':meta_desc' => $_POST['meta_desc'] ?? '',
                ':published_at' => ($_POST['status'] === 'published') ? date('Y-m-d H:i:s') : null
            ];

            $articleId = $articleModel->save($data);

            // Sync Selected Tags
            $selectedTags = $_POST['tags'] ?? [];
            
            // Process Custom Tags
            if (!empty($_POST['custom_tags'])) {
                $customTags = explode(',', $_POST['custom_tags']);
                $tagModel = new TagModel();
                $db = \Core\Database::getInstance();
                
                foreach ($customTags as $tagName) {
                    $tagName = trim($tagName);
                    if (empty($tagName)) continue;
                    
                    // Check if tag exists
                    $stmt = $db->prepare("SELECT id FROM tags WHERE LOWER(name) = LOWER(:name) LIMIT 1");
                    $stmt->execute([':name' => $tagName]);
                    $existing = $stmt->fetch();
                    
                    if ($existing) {
                        $selectedTags[] = $existing['id'];
                    } else {
                        // Create new tag
                        $newTagId = $tagModel->save([
                            ':name' => $tagName,
                            ':slug' => SlugHelper::create($tagName),
                            ':lang' => $data[':lang']
                        ]);
                        $selectedTags[] = $newTagId;
                    }
                }
            }

            // Sync all tags to article_tags
            if (!empty($selectedTags)) {
                $db = \Core\Database::getInstance();
                $selectedTags = array_unique($selectedTags);
                foreach ($selectedTags as $tagId) {
                    $stmt = $db->prepare("INSERT IGNORE INTO article_tags (article_id, tag_id) VALUES (:article_id, :tag_id)");
                    $stmt->execute([':article_id' => $articleId, ':tag_id' => $tagId]);
                }
            }

            header('Location: ' . SITE_URL . '/admin/articles');
            exit;
        }
    }

    public function edit($id) {
        $articleModel = new ArticleModel();
        $catModel = new CategoryModel();
        $subModel = new SubcategoryModel();
        $tagModel = new TagModel();
        
        $stmt = \Core\Database::getInstance()->prepare("
            SELECT a.*, m.path AS image_path 
            FROM articles a 
            LEFT JOIN media m ON a.featured_image = m.id 
            WHERE a.id = :id
        ");
        $stmt->execute([':id' => $id]);
        $article = $stmt->fetch();

        if (!$article) {
            die("Article not found");
        }

        // Get currently selected tags
        $stmt = \Core\Database::getInstance()->prepare("SELECT tag_id FROM article_tags WHERE article_id = :id");
        $stmt->execute([':id' => $id]);
        $selectedTags = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        $this->render('admin/articles/edit', [
            'title' => 'Edit Article',
            'article' => $article,
            'categories' => $catModel->getAll(),
            'subcategories' => $subModel->getAll(),
            'tags' => $tagModel->getAll(),
            'selectedTags' => $selectedTags
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleModel = new ArticleModel();
            $db = \Core\Database::getInstance();
            
            // Get old data for redirect check
            $stmt = $db->prepare("
                SELECT a.slug, a.lang, c.slug as cat_slug 
                FROM articles a 
                LEFT JOIN categories c ON a.category_id = c.id 
                WHERE a.id = :id
            ");
            $stmt->execute([':id' => $id]);
            $oldArticle = $stmt->fetch();

            $title = $_POST['title'] ?? '';
            if (mb_strlen($title) < 20) {
                die("Error: Article headline must be at least 20 characters long.");
            }

            $slug = !empty($_POST['slug']) ? SlugHelper::create($_POST['slug']) : SlugHelper::create($title);

            $featuredImageId = $_POST['current_featured_image'] ?? null;
            if (!empty($_FILES['image']['name'])) {
                try {
                    $uploadResult = ImageHelper::processUpload($_FILES['image']);
                    $stmt = $db->prepare("INSERT INTO media (path, type) VALUES (:path, 'image')");
                    $stmt->execute([':path' => $uploadResult['path']]);
                    $featuredImageId = $db->lastInsertId();
                } catch (\Exception $e) {}
            }

            $data = [
                'title' => $title,
                'slug' => $slug,
                'body' => $_POST['body'] ?? '',
                'excerpt' => $_POST['excerpt'] ?? '',
                'category_id' => $_POST['category_id'] ?? null,
                'subcategory_id' => $_POST['subcategory_id'] ?: null,
                'lang' => $_POST['lang'] ?? 'pa',
                'status' => $_POST['status'] ?? 'draft',
                'priority' => $_POST['priority'] ?? 'normal',
                'featured_image' => $featuredImageId,
                'seo_title' => $_POST['seo_title'] ?? '',
                'meta_desc' => $_POST['meta_desc'] ?? '',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($_POST['status'] === 'published' && empty($_POST['published_at'])) {
                $data['published_at'] = date('Y-m-d H:i:s');
            }

            $articleModel->update($id, $data);

            // Handle SEO Redirects if URL changed
            if ($oldArticle && $data['status'] === 'published') {
                $stmt = $db->prepare("SELECT slug FROM categories WHERE id = :id");
                $stmt->execute([':id' => $data['category_id']]);
                $newCatSlug = $stmt->fetchColumn();

                $oldUrl = "{$oldArticle['lang']}/{$oldArticle['cat_slug']}/{$oldArticle['slug']}";
                $newUrl = "{$data['lang']}/{$newCatSlug}/{$data['slug']}";

                if ($oldUrl !== $newUrl) {
                    $redirectModel = new \App\Models\RedirectModel();
                    $redirectModel->create($oldUrl, $newUrl);
                }
            }

            // Update Tags
            $db = \Core\Database::getInstance();
            $db->prepare("DELETE FROM article_tags WHERE article_id = :id")->execute([':id' => $id]);
            
            $selectedTags = $_POST['tags'] ?? [];
            
            // Process Custom Tags
            if (!empty($_POST['custom_tags'])) {
                $customTags = explode(',', $_POST['custom_tags']);
                $tagModel = new TagModel();
                
                foreach ($customTags as $tagName) {
                    $tagName = trim($tagName);
                    if (empty($tagName)) continue;
                    
                    $stmt = $db->prepare("SELECT id FROM tags WHERE LOWER(name) = LOWER(:name) LIMIT 1");
                    $stmt->execute([':name' => $tagName]);
                    $existing = $stmt->fetch();
                    
                    if ($existing) {
                        $selectedTags[] = $existing['id'];
                    } else {
                        $newTagId = $tagModel->save([
                            ':name' => $tagName,
                            ':slug' => SlugHelper::create($tagName),
                            ':lang' => $data['lang']
                        ]);
                        $selectedTags[] = $newTagId;
                    }
                }
            }

            if (!empty($selectedTags)) {
                $selectedTags = array_unique($selectedTags);
                foreach ($selectedTags as $tagId) {
                    $db->prepare("INSERT IGNORE INTO article_tags (article_id, tag_id) VALUES (:article_id, :tag_id)")
                       ->execute([':article_id' => $id, ':tag_id' => $tagId]);
                }
            }

            header('Location: ' . SITE_URL . '/admin/articles');
            exit;
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleModel = new ArticleModel();
            $articleModel->delete($id);
            header('Location: /News_Website/admin/articles');
            exit;
        }
    }
}
