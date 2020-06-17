<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModelRequest as Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Model;
use App\Models\ModelImage;
use App\Traits\ImageHandling;
use App\Http\Resources\ModelResource;

class ModelController extends Controller
{
    use ImageHandling;

    public function index(Brand $brand, Category $category)
    {
        $models = $category->models;

        return view('dashboard.model')->with(compact('brand', 'category', 'models'));
    }

    public function show(Brand $brand, Category $category, Model $model)
    {
        $descriptionImage   = $model->images()->where('type', 'description')->orderBy('sort')->get();
        $specifications     = $model->specifications()->orderBy('sort')->get();
        $galery             = $model->images()->where('type', 'galery')->orderBy('sort')->get();
        $testimonies        = $model->testimonies()->get();

        return view('dashboard.model-detail')->with(compact(
            'brand', 
            'category', 
            'model', 
            'descriptionImage',
            'specifications',
            'galery',
            'testimonies'
        ));
    }

    public function store(Request $request, Brand $brand, Category $category)
    {
        $imgSize = config('multicraneperkasa.img-size.model-display');

        $image = $this->storeCroppedImage(
            $request->image, 
            ModelImage::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop            
        );
        
        $model = $category->models()->create(array_replace($request->all(), [
            'slug'  => strtolower(str_replace(' ', '-', $request->name)),
        ]));

        $model->images()->create([
            'name'  => $image,
            'type'  => 'display',
        ]);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function edit(Brand $brand, Category $category, Model $model)
    {
        return response()->json(['data' => new ModelResource($model)]);
    }

    public function update(Request $request, Brand $brand, Category $category, Model $model)
    {
        $update = $request->all();
        $image = $model->images()->where('type', 'display')->first();

        if ($request->image) {
            $imgSize = config('multicraneperkasa.img-size.model-display');
            $imageName = $this->storeCroppedImage(
                $request->image, 
                ModelImage::IMAGE_FOLDER, 
                $imgSize,
                $request->image_crop                     
            );

            if ($image) {
                $image->deleteImage();
                $image->update(['name' => $imageName]);
            } else {
                $model->images()->create([
                    'name'  => $imageName,
                    'type'  => 'display',
                ]);
            }
        }

        $model->update($update);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(Brand $brand, Category $category, Model $model)
    {
        $model->delete();

        return redirect()->to(url()->previous())->with('model', 'Data is successfully deleted!');
    }
}
