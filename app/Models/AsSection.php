<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Storage;

class AsSection extends Model implements TranslatableContract
{
    use Translatable;
   
    const IMAGE_FOLDER = 'upload/images/after-sales-section/';

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['image', 'sort'];
    protected $appends = ['image_url', 'slug'];

    public function getImageUrlAttribute()
    {   
        if (file_exists($this->getImagePath())) {
            return asset('storage/' . self::IMAGE_FOLDER . $this->image);
        };

        return null;
    }

    public function getSlugAttribute()
    {   
        return str_replace(' ', '-', $this->name);
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

    public function sale()
    {
        return $this->belongsTo('App\Models\AfterSale');
    }
}
