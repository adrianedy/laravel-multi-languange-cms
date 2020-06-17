<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Position extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['description'];
    protected $fillable = ['name', 'department', 'location', 'level', 'deadline', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
