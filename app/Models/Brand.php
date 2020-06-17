<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    const IMAGE_FOLDER = 'upload/images/brand/';

    protected $fillable = ['name', 'image', 'slug', 'sort'];

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
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function models()
    {
        return $this->hasManyThrough('App\Models\Model', 'App\Models\Category');
    }
}
