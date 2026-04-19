<?php

namespace App\Helpers;

use App\Models\ArticleModel;

class SlugHelper {
    /**
     * Create a URL-friendly slug from a string
     */
    public static function create(string $text): string {
        // Convert to lowercase and replace non-alphanumeric with hyphens
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/[^a-z0-9\x{0A00}-\x{0A7F}\x{0900}-\x{097F}-]/u', '-', $text);
        $text = preg_replace('/-+/', '-', $text);
        return trim($text, '-');
    }

    /**
     * Ensure slug is unique in the articles table
     */
    public static function ensureUnique(string $slug, string $lang, ?int $excludeId = null): string {
        $model = new ArticleModel();
        // This would require a specific check in the Model
        // For now, returning the slug
        return $slug;
    }
}
