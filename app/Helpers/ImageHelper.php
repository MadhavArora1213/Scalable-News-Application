<?php

namespace App\Helpers;

use Exception;

class ImageHelper {
    /**
     * Process image upload: Resize, Convert to WebP, Create Thumbnail
     */
    public static function processUpload(array $file): array {
        // Security: validate MIME type from file content
        $mime = \mime_content_type($file['tmp_name']);
        if (!\in_array($mime, ['image/jpeg', 'image/png', 'image/webp'])) {
            throw new Exception('Invalid file type. Only JPEG, PNG, and WebP are allowed.');
        }

        $extension = \pathinfo($file['name'], PATHINFO_EXTENSION);
        $name = \uniqid() . '_' . \time();
        $datePath = \date('Y/m');
        $dir = PUBLIC_PATH . '/uploads/' . $datePath . '/';
        
        if (!\is_dir($dir)) {
            \mkdir($dir, 0755, true);
        }

        // Check if GD extension is available for processing
        if (!\function_exists('imagecreatefromstring')) {
            // Fallback: Just move the file without processing
            $targetPath = $dir . $name . '.' . $extension;
            if (\move_uploaded_file($file['tmp_name'], $targetPath)) {
                return [
                    'path'  => '/uploads/' . $datePath . '/' . $name . '.' . $extension,
                    'thumb' => '/uploads/' . $datePath . '/' . $name . '.' . $extension // No thumb possible
                ];
            }
            throw new Exception('Failed to upload file.');
        }

        // Create image resource
        $src = \imagecreatefromstring(\file_get_contents($file['tmp_name']));
        if (!$src) {
            throw new Exception('Failed to process image content.');
        }

        [$w, $h] = [\imagesx($src), \imagesy($src)];

        // 1. Process Main Image (Standard 16:9 - 1200x675)
        $targetW = 1200;
        $targetH = 675;
        $aspectRatio = $targetW / $targetH;
        
        $currentRatio = $w / $h;
        
        if ($currentRatio > $aspectRatio) {
            // Wider than 16:9
            $cropW = (int)($h * $aspectRatio);
            $cropH = $h;
            $srcX = (int)(($w - $cropW) / 2);
            $srcY = 0;
        } else {
            // Taller than 16:9
            $cropW = $w;
            $cropH = (int)($w / $aspectRatio);
            $srcX = 0;
            $srcY = (int)(($h - $cropH) / 2);
        }

        $resized = \imagecreatetruecolor($targetW, $targetH);
        \imagecopyresampled($resized, $src, 0, 0, $srcX, $srcY, $targetW, $targetH, $cropW, $cropH);
        
        $mainPath = $dir . $name . '.webp';
        \imagewebp($resized, $mainPath, 82);

        // 2. Process Thumbnail (480x270 - already 16:9)
        $thumb = \imagecreatetruecolor(480, 270);
        \imagecopyresampled($thumb, $resized, 0, 0, 0, 0, 480, 270, $targetW, $targetH);
        $thumbPath = $dir . $name . '_thumb.webp';
        \imagewebp($thumb, $thumbPath, 75);

        // Cleanup
        \imagedestroy($src);
        \imagedestroy($resized);
        \imagedestroy($thumb);

        return [
            'path'  => '/uploads/' . $datePath . '/' . $name . '.webp',
            'thumb' => '/uploads/' . $datePath . '/' . $name . '_thumb.webp'
        ];
    }
}
