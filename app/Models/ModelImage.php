<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ModelImage extends Model
{
    protected $fillable = ['name', 'type', 'sort'];

    const IMAGE_FOLDER = 'upload/images/model/';

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {   
        if (file_exists($this->getImagePath())) {
            return asset('storage/' . self::IMAGE_FOLDER . $this->name);
        };

        return "http://via.placeholder.com/" . implode('x', config('multicraneperkasa.img-size.model-display'));
    }

    public function getImagePath()
    {   
        return 'storage/' . self::IMAGE_FOLDER . $this->name;
    }

    public function deleteImage()
    {
        return Storage::delete("public/" . self::IMAGE_FOLDER . $this->name);
    }

    
    public function delete()
    {
        $this->deleteImage();

        return parent::delete();
    }
    
    public function model(){
        return $this->belongsTo('App\Models\Model');
    }
}
