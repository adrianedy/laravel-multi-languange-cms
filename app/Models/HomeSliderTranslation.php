<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSliderTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'button_label', 'button_url'];
}
