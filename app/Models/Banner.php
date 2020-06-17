<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    const IMAGE_FOLDER = 'upload/images/banner/';

    protected $fillable = ['name', 'page'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {   
        if (file_exists($this->getImagePath())) {
            return asset('storage/' . self::IMAGE_FOLDER . $this->name);
        };

        return null;
    }

    public function getImagePath()
    {   
        return 'storage/' . self::IMAGE_FOLDER . $this->name;
    }

    public function deleteImage()
    {
        return Storage::delete("public/" . self::IMAGE_FOLDER . $this->name);
    }

    public function delete()
    {
        $this->deleteImage();

        return parent::delete();
    }
}
