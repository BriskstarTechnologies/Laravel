<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Store an image in the specified disk and return the path.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $directory
     * @param string $disk
     * @return string
     */
    public static function storeImage($image, $directory = 'images', $disk = 'public')
    {
        // Generate a unique filename based on the current timestamp and a random string
        $filename = Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();

        // Store the image in the specified directory on the specified disk
        $path = $image->storeAs($directory, $filename, $disk);

        return $path;
    }
}
