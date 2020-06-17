<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ModelParent;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Storage;

class Model extends ModelParent implements TranslatableContract
{
    use Translatable;

    const CATALOG_FOLDER = 'upload/catalog/model/';

    public $translatedAttributes = ['description'];

    protected $fillable = ['name', 'catalog', 'video', 'slug'];

    protected $appends = ['display_image_url', 'catalog_url', 'brand_name', 'category_name'];

    public function getDisplayImageUrlAttribute()
    {   
        return $this->images()->where('type', 'display')->first()->image_url ?? 
        "http://via.placeholder.com/" . implode('x', config('multicraneperkasa.img-size.model-display'));
    }

    public function getCatalogUrlAttribute()
    {   
        if (file_exists($this->getCatalogPath()) && $this->catalog) {
            return asset('storage/' . self::CATALOG_FOLDER . $this->catalog);
        };

        return null;
    }

    public function getCatalogPath()
    {   
        return 'storage/' . self::CATALOG_FOLDER . $this->catalog;
    }

    public function deleteCatalog()
    {
        return Storage::delete("public/" . self::CATALOG_FOLDER . $this->catalog);
    }

    public function getBrandNameAttribute()
    {   
        return $this->category->brand->name;
    }

    public function getCategoryNameAttribute()
    {   
        return $this->category->name;
    }

    public function delete()
    {   
        foreach($this->images as $image) {
            $image->deleteImage();
        }

        $this->deleteCatalog();

        return parent::delete();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function specifications()
    {
        return $this->hasMany('App\Models\Specification');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ModelImage');
    }

    public function testimonies()
    {
        return $this->hasMany('App\Models\Testimony');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
