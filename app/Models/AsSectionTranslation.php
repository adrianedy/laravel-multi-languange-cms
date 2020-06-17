<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsSectionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
}
