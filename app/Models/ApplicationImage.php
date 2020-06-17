<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ApplicationImage extends Model
{
    protected $fillable = ['name', 'sort'];

    const IMAGE_FOLDER = 'upload/images/application/';

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
    
    public function application(){
        return $this->belongsTo('App\Models\application');
    }
}
