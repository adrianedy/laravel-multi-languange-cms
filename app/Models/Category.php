<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $fillable = ['slug', 'sort'];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function models()
    {
        return $this->hasMany('App\Models\Model');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
