<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class AfterSale extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sections()
    {
        return $this->hasMany('App\Models\AsSection');
    }
}
