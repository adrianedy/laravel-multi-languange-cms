<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTranslation extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['description'];
}
