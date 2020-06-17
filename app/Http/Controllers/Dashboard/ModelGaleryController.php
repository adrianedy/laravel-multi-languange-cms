<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ImageHandling;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Model;
use App\Models\ModelImage;

class ModelGaleryController extends Controller
{
    use ImageHandling;

    public function store(Request $request, Brand $brand, Category $category, Model $model)
    {
        $request->validate(['image' => 'required|image|max:128000']);

        $lastSort = $model->images()->where('type', 'galery')->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $imgSize = config('multicraneperkasa.img-size.galery');

        $image = $this->storeCroppedImage(
            $request->image, 
            ModelImage::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );

        $model->images()->create(['name' => $image, 'type' => 'galery','sort' => $sort]);

        return response()->json(['data' => ['location' => 'galery', 'message' => 'Data is successfully updated!']]);
    }

    public function destroy(Brand $brand, Category $category, Model $model, ModelImage $image)
    {
        $image->delete();

        return redirect()->to(url()->previous() . '#galery')->with('galery', 'Data is successfully deleted!');
    }

    public function sort(Brand $brand, Category $category, Model $model, ModelImage $image, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchImage    = $model->images()->where('type', 'galery')->where('sort', $sort, $image->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchImage) {
            $switchSort        = $switchImage->sort;
            $switchImage->sort = $image->sort;
            $switchImage->save();

            $image->sort = $switchSort;
            $image->save();
        }
        
        return redirect()->to(url()->previous() . '#galery')->with('galery', 'Data is successfully updated!');
    }
}
