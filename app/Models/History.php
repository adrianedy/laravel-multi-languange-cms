<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['year'];

    public function getRouteKeyName()
    {
        return 'year';
    }

    public function images()
    {
        return $this->hasMany('App\Models\HistoryImage');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }
}
