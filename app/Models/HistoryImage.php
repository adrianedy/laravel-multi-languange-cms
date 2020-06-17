<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HistoryImage extends Model
{
    protected $fillable = ['name', 'sort'];
    protected $appends = ['image_url'];
    const IMAGE_FOLDER = 'upload/images/history/';

    public function getImageUrlAttribute()
    {   
        if (file_exists($this->getImagePath())) {
            return asset('storage/' . self::IMAGE_FOLDER . $this->name);
        };

        return null;
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

    public function history()
    {
        return $this->belongsTo('App\Models\History');
    }
}
