<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class CompanyProfile extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['description'];
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany('App\Models\CompanyProfileImage');
    }
}
