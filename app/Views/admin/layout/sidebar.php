<aside class="admin-sidebar">
    <div class="sidebar-logo">ਖ਼ਬਰਾਂ NEWS</div>
    
    <nav class="sidebar-nav">
        <a href="<?= SITE_URL ?>/admin/dashboard" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') !== false ? 'active' : '' ?>">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <div class="nav-group-label">Core Editorial</div>
        
        <!-- Articles Dropdown -->
        <div class="nav-item-dropdown <?= strpos($_SERVER['REQUEST_URI'], '/admin/articles') !== false ? 'open' : '' ?>">
            <div class="nav-link dropdown-toggle">
                <span><i class="fas fa-file-invoice"></i> Articles</span>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= SITE_URL ?>/admin/articles" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/admin/articles') !== false && strpos($_SERVER['REQUEST_URI'], '/admin/articles/new') === false && strpos($_SERVER['REQUEST_URI'], '/edit') === false) ? 'active' : '' ?>">
                        <i class="fas fa-list"></i> All Articles
                    </a>
                </li>
                <li>
                    <a href="<?= SITE_URL ?>/admin/articles/new" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/articles/new') !== false ? 'active' : '' ?>">
                        <i class="fas fa-plus-circle"></i> Create Article
                    </a>
                </li>
            </ul>
        </div>

        <!-- Categories Dropdown -->
        <div class="nav-item-dropdown <?= strpos($_SERVER['REQUEST_URI'], '/admin/categories') !== false ? 'open' : '' ?>">
            <div class="nav-link dropdown-toggle">
                <span><i class="fas fa-folder-tree"></i> Categories</span>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= SITE_URL ?>/admin/categories" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/admin/categories') !== false && strpos($_SERVER['REQUEST_URI'], '/admin/categories/new') === false && strpos($_SERVER['REQUEST_URI'], '/edit') === false) ? 'active' : '' ?>">
                        <i class="fas fa-list"></i> All Categories
                    </a>
                </li>
                <li>
                    <a href="<?= SITE_URL ?>/admin/categories/new" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/categories/new') !== false ? 'active' : '' ?>">
                        <i class="fas fa-plus-circle"></i> Create Category
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tags Dropdown -->
        <div class="nav-item-dropdown <?= strpos($_SERVER['REQUEST_URI'], '/admin/tags') !== false ? 'open' : '' ?>">
            <div class="nav-link dropdown-toggle">
                <span><i class="fas fa-tags"></i> Tags</span>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= SITE_URL ?>/admin/tags" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/admin/tags') !== false && strpos($_SERVER['REQUEST_URI'], '/admin/tags/new') === false && strpos($_SERVER['REQUEST_URI'], '/edit') === false) ? 'active' : '' ?>">
                        <i class="fas fa-list"></i> All Tags
                    </a>
                </li>
                <li>
                    <a href="<?= SITE_URL ?>/admin/tags/new" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/tags/new') !== false ? 'active' : '' ?>">
                        <i class="fas fa-plus-circle"></i> Create Tag
                    </a>
                </li>
            </ul>
        </div>

        <!-- Subcategories Dropdown -->
        <div class="nav-item-dropdown <?= strpos($_SERVER['REQUEST_URI'], '/admin/subcategories') !== false ? 'open' : '' ?>">
            <div class="nav-link dropdown-toggle">
                <span><i class="fas fa-sitemap"></i> Subcategories</span>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= SITE_URL ?>/admin/subcategories" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/admin/subcategories') !== false && strpos($_SERVER['REQUEST_URI'], '/admin/subcategories/new') === false && strpos($_SERVER['REQUEST_URI'], '/edit') === false) ? 'active' : '' ?>">
                        <i class="fas fa-list"></i> All Subcategories
                    </a>
                </li>
                <li>
                    <a href="<?= SITE_URL ?>/admin/subcategories/new" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/subcategories/new') !== false ? 'active' : '' ?>">
                        <i class="fas fa-plus-circle"></i> Create Subcategory
                    </a>
                </li>
            </ul>
        </div>

        <a href="<?= SITE_URL ?>/admin/roles" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/roles') !== false ? 'active' : '' ?>">
            <i class="fas fa-user-shield"></i> Roles & Permissions
        </a>
        
        <a href="<?= SITE_URL ?>/admin/breaking" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/breaking') !== false ? 'active' : '' ?>">
            <i class="fas fa-bolt"></i> Breaking News
        </a>

        <a href="<?= SITE_URL ?>/admin/settings" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/settings') !== false ? 'active' : '' ?>">
            <i class="fas fa-sliders-h"></i> Settings
        </a>

        <!-- Other modules (kept if they exist in controllers, but user wanted simplified) -->
        <?php if (isset($show_all_modules) && $show_all_modules): ?>
            <a href="<?= SITE_URL ?>/admin/categories" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'categories') ? 'active' : '' ?>">
                <i class="fas fa-folder-tree"></i> Categories
            </a>
            <a href="<?= SITE_URL ?>/admin/media" class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], 'media') ? 'active' : '' ?>">
                <i class="fas fa-images"></i> Media Assets
            </a>
        <?php endif; ?>

    </nav>

    <div class="sidebar-footer">
        <a href="<?= SITE_URL ?>/admin/logout" class="logout-btn">
            <i class="fas fa-power-off"></i> Logout
        </a>
    </div>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            parent.classList.toggle('open');
        });
    });
});
</script>
