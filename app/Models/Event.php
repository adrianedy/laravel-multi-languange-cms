<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Event extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['sort'];

    public function history()
    {
        return $this->belongsTo('App\Models\History');
    }
}
