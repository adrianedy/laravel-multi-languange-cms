<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTranslation extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['title', 'description', 'url'];
}
