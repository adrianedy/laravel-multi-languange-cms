<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'salutation',
        'first_name',
        'mid_name',
        'last_name',
        'company',
        'mail',
        'country_code',
        'area_code',
        'phone',
        'province',
        'city',
        'post_code',
        'category',
        'model',
        'comments'
    ];
}
