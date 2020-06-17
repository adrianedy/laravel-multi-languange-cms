<?php

namespace App\Traits;

use Image;
use Carbon\Carbon;

trait ImageHandling
{
    public function storeCroppedImage($image, $folder, $size, $crop, $name = null)
    {
        if (!file_exists(public_path('storage/' . $folder))) {
            mkdir(public_path('storage/' . $folder), 755, true);
        }

        $name   = $name ?? $this->imageNameGenerator($image->getClientOriginalExtension());
        $store  = Image::make($image->getRealPath())
                ->crop(round($crop['width']), round($crop['height']), round($crop['x']), round($crop['y']))
                ->resize($size[0], $size[1])
                ->save(public_path('storage/' . $folder) . $name);

        if ($store) {  
            return $name;
        } else {
            return false;
        }
    }

    public function storeImage($image, $folder, $name = null)
    {
        if (!file_exists(public_path('storage/' . $folder))) {
            mkdir(public_path('storage/' . $folder), 755, true);
        }

        $name   = $name ?? $this->imageNameGenerator($image->getClientOriginalExtension());
        $store  = Image::make($image->getRealPath())->save(public_path('storage/' . $folder) . $name);

        if ($store) {  
            return $name;
        } else {
            return false;
        }
    }

    public function imageNameGenerator($extension = 'jpg')
    {
        return uniqid('img_') . strtotime(Carbon::now()) . '.' . $extension;
    }
}
