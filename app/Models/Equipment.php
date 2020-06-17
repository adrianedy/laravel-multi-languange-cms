<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = ['model_id', 'sort'];
    protected $appends = ['brand_name'];

    public function getBrandNameAttribute()
    {   
        return $this->model->category->brand->name;
    }

    public function model()
    {
        return $this->belongsTo('App\Models\Model');
    }
}
