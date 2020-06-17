<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationProduct extends Model
{
    protected $fillable = ['model_id', 'sort'];
    
    public function model()
    {
        return $this->belongsTo('App\Models\Model');
    }

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }
}
