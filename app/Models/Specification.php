<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Specification extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name', 'detail'];
    protected $fillable = ['sort'];

    public function model()
    {
        return $this->belongsTo('App\Models\Model');
    }
}
