<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Application extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['video', 'slug', 'sort'];

    public function delete()
    {   
        foreach($this->images as $image) {
            $image->deleteImage();
        }

        return parent::delete();
    }

    public function images()
    {
        return $this->hasMany('App\Models\ApplicationImage');
    }

    public function products()
    {
        return $this->hasMany('App\Models\ApplicationProduct');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
