<?php

namespace App\Helpers;

use Exception;

class ImageHelper {
    /**
     * Process image upload: Resize, Convert to WebP, Create Thumbnail
     */
    public static function processUpload(array $file): array {
        // Security: validate MIME type from file content
        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'])) {
            throw new Exception('Invalid file type. Only JPEG, PNG, and WebP are allowed.');
        }

        $name = uniqid() . '_' . time();
        $datePath = date('Y/m');
        $dir = PUBLIC_PATH . '/uploads/' . $datePath . '/';
        
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Create image resource
        $src = imagecreatefromstring(file_get_contents($file['tmp_name']));
        if (!$src) {
            throw new Exception('Failed to process image content.');
        }

        [$w, $h] = [imagesx($src), imagesy($src)];

        // 1. Process Main Image (Max 1200px wide)
        if ($w > 1200) {
            $newH = (int)($h * 1200 / $w);
            $resized = imagescale($src, 1200, $newH);
        } else {
            $resized = $src;
        }
        
        $mainPath = $dir . $name . '.webp';
        imagewebp($resized, $mainPath, 82);

        // 2. Process Thumbnail (480x270 - cropped or scaled)
        $thumb = imagescale($src, 480, 270);
        $thumbPath = $dir . $name . '_thumb.webp';
        imagewebp($thumb, $thumbPath, 75);

        // Cleanup
        imagedestroy($src);
        if ($resized !== $src) imagedestroy($resized);
        imagedestroy($thumb);

        return [
            'path'  => '/uploads/' . $datePath . '/' . $name . '.webp',
            'thumb' => '/uploads/' . $datePath . '/' . $name . '_thumb.webp'
        ];
    }
}
