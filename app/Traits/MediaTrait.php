<?php

namespace App\Traits;

trait MediaTrait
{
    public function saveVideo($folder, $video)
    {
        $video->store('/', $folder);
        $filename = $video->hashName();
        $path = 'courses/' . $folder . '/' . $filename;
        return $path;
    }


    public function saveImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = 'images/' . $folder . '/' . $filename;
        return $path;
    }
}
