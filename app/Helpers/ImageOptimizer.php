<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageOptimizer
{
    /**
     * Resizes and compresses an image file in-place if GD is loaded.
     *
     * @param string $filePath Relative storage path
     * @param int $quality Target quality percent (0-100)
     * @param int $maxWidth Max width allowed
     */
    public static function optimize(string $filePath, int $quality = 75, int $maxWidth = 1920): void
    {
        // Check if there is an explicit request to skip compression
        if (request()->has('compress_image_submitted') && !request()->has('compress_image')) {
            return;
        }

        if (!extension_loaded('gd')) {
            return;
        }

        $disk = Storage::disk('public');
        $absolutePath = $disk->path($filePath);

        if (!file_exists($absolutePath)) {
            return;
        }

        $info = @getimagesize($absolutePath);
        if (!$info) {
            return;
        }

        $mime = $info['mime'];
        $width = $info[0];
        $height = $info[1];

        // 1. Load image resource
        switch ($mime) {
            case 'image/jpeg':
                $image = @imagecreatefromjpeg($absolutePath);
                break;
            case 'image/png':
                $image = @imagecreatefrompng($absolutePath);
                break;
            case 'image/webp':
                $image = @imagecreatefromwebp($absolutePath);
                break;
            default:
                return;
        }

        if (!$image) {
            return;
        }

        // 2. Resize if it exceeds maxWidth
        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int)(($height / $width) * $maxWidth);
            
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve alpha channel transparency for PNG/WebP
            if ($mime === 'image/png' || $mime === 'image/webp') {
                imagealphablending($resizedImage, false);
                imagesavealpha($resizedImage, true);
            }
            
            imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resizedImage;
        }

        // 3. Save compressed image back in-place
        switch ($mime) {
            case 'image/jpeg':
                @imagejpeg($image, $absolutePath, $quality);
                break;
            case 'image/png':
                @imagealphablending($image, false);
                @imagesavealpha($image, true);
                // Convert quality (0-100) to PNG compression level (0-9)
                $pngQuality = (int)round((100 - $quality) / 11.11);
                $pngQuality = max(0, min(9, $pngQuality));
                @imagepng($image, $absolutePath, $pngQuality);
                break;
            case 'image/webp':
                @imagewebp($image, $absolutePath, $quality);
                break;
        }

        @imagedestroy($image);
    }
}
