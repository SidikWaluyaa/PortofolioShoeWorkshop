<?php

namespace Tests\Feature;

use App\Helpers\ImageCompressionHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageCompressionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /**
     * Test image compression resizes and converts to JPG.
     */
    public function test_image_compression_resizes_and_converts_to_jpg(): void
    {
        // Create a large 1000x1200 PNG image
        $width = 1000;
        $height = 1200;
        $imageResource = imagecreatetruecolor($width, $height);
        
        // Fill background with white
        $white = imagecolorallocate($imageResource, 255, 255, 255);
        imagefill($imageResource, 0, 0, $white);
        
        // Save to temp path
        $tempPath = tempnam(sys_get_temp_dir(), 'test_img') . '.png';
        imagepng($imageResource, $tempPath);
        imagedestroy($imageResource);

        $uploadedFile = new UploadedFile(
            $tempPath,
            'large_image.png',
            'image/png',
            null,
            true
        );

        // Compress and store
        $storedPath = ImageCompressionHelper::compressAndStore($uploadedFile, 'test_uploads');

        // Clean up temp file
        @unlink($tempPath);

        // Assert file exists on disk
        $this->assertTrue(Storage::disk('public')->exists($storedPath));

        // Assert path ends with .jpg
        $this->assertStringEndsWith('.jpg', $storedPath);

        // Get stored image dimensions
        $fullPath = Storage::disk('public')->path($storedPath);
        $imageInfo = getimagesize($fullPath);

        $this->assertNotFalse($imageInfo);
        $this->assertEquals('image/jpeg', $imageInfo['mime']);
        
        // Stored dimensions must be resized to max 800x800, maintaining aspect ratio.
        // Original: 1000x1200. Max height 800 -> new width = 1000 * (800/1200) = 667
        $this->assertLessThanOrEqual(800, $imageInfo[0]);
        $this->assertLessThanOrEqual(800, $imageInfo[1]);
        $this->assertEquals(800, $imageInfo[1]); // height should be exactly 800
        $this->assertEquals(667, $imageInfo[0]); // width should be 667
    }
}
