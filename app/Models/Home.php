<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Home extends Model implements TranslatableContract
{
    use Translatable;

    const IMAGE_FOLDER = 'upload/images/home/';

    protected $fillable = ['image'];

    public $translatedAttributes = ['title', 'description', 'url'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {   
        if (file_exists($this->getImagePath())) {
            return asset('storage/' . self::IMAGE_FOLDER . $this->image);
        };

        return null;
    }

    public function getImagePath()
    {   
        return 'storage/' . self::IMAGE_FOLDER . $this->image;
    }
}
