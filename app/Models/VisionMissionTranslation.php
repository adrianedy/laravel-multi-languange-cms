<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMissionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['vision', 'mission'];
}
