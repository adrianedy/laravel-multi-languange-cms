<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Office extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name', 'address'];
    protected $fillable = ['phone_number', 'latitude', 'longitude', 'sort'];
}
