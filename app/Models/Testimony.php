<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Storage;

class Testimony extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['testimony'];
    protected $fillable = ['name', 'image', 'profession'];
    const IMAGE_FOLDER = 'upload/images/testimonies/';
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

    public function deleteImage()
    {
        return Storage::delete("public/" . self::IMAGE_FOLDER . $this->image);
    }

    
    public function delete()
    {
        $this->deleteImage();

        return parent::delete();
    }

    public function model()
    {
        return $this->belongsTo('App\Models\Model');
    }
}
