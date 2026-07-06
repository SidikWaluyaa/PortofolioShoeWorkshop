<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageCompressionHelper
{
    /**
     * Compress and store an uploaded image.
     *
     * Resizes the image to a maximum of 800x800 pixels (maintaining aspect ratio)
     * and compresses to JPG format at 60% quality.
     *
     * @param UploadedFile $file The uploaded image file
     * @param string $directory The storage directory (relative to public disk)
     * @param string|null $filename Optional custom filename (without extension)
     * @param bool $squareCrop If true, crop the image to a 1:1 square centered
     * @return string The stored file path relative to storage
     */
    public static function compressAndStore(UploadedFile $file, string $directory, ?string $filename = null, bool $squareCrop = false): string
    {
        $maxWidth = 800;
        $maxHeight = 800;
        $quality = 60;

        // Generate filename
        $filename = $filename ?? Str::uuid();
        $storedPath = $directory . '/' . $filename . '.jpg';

        // Get image info
        $imageInfo = getimagesize($file->getPathname());
        if ($imageInfo === false) {
            // Fallback: if not a valid image, just store the file as-is
            return $file->store($directory, 'public');
        }

        $mime = $imageInfo['mime'];
        $originalWidth = $imageInfo[0];
        $originalHeight = $imageInfo[1];

        // Create image resource based on mime type
        $sourceImage = match ($mime) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($file->getPathname()),
            'image/png' => imagecreatefrompng($file->getPathname()),
            'image/gif' => imagecreatefromgif($file->getPathname()),
            'image/webp' => imagecreatefromwebp($file->getPathname()),
            'image/bmp' => imagecreatefrombmp($file->getPathname()),
            default => null,
        };

        if ($sourceImage === null) {
            // Unsupported format, store as-is
            return $file->store($directory, 'public');
        }

        if ($squareCrop) {
            $minDim = min($originalWidth, $originalHeight);
            $cropX = (int) round(($originalWidth - $minDim) / 2);
            $cropY = (int) round(($originalHeight - $minDim) / 2);
            
            // Resize the squared crop to maxWidth x maxHeight (or keep it smaller if original was smaller)
            $targetDim = min($maxWidth, $minDim);
            $newWidth = $targetDim;
            $newHeight = $targetDim;
            
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            
            $white = imagecolorallocate($resizedImage, 255, 255, 255);
            imagefill($resizedImage, 0, 0, $white);
            
            imagecopyresampled(
                $resizedImage,
                $sourceImage,
                0, 0, $cropX, $cropY,
                $newWidth, $newHeight,
                $minDim, $minDim
            );
        } else {
            // Calculate new dimensions maintaining aspect ratio
            $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight, 1);
            $newWidth = (int) round($originalWidth * $ratio);
            $newHeight = (int) round($originalHeight * $ratio);

            // Create resized image
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency for PNG (convert to white background for JPG output)
            $white = imagecolorallocate($resizedImage, 255, 255, 255);
            imagefill($resizedImage, 0, 0, $white);

            imagecopyresampled(
                $resizedImage,
                $sourceImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $originalWidth, $originalHeight
            );
        }

        // Save to temporary file first
        $tempPath = sys_get_temp_dir() . '/' . $filename . '.jpg';
        imagejpeg($resizedImage, $tempPath, $quality);

        // Free memory
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);

        // Store the compressed file
        Storage::disk('public')->put($storedPath, file_get_contents($tempPath));

        // Clean up temp file
        @unlink($tempPath);

        return $storedPath;
    }
}
