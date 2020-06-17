<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ModelDetailRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Model;
use App\Traits\ImageHandling;
use App\Models\ModelImage;

class ModelDetailController extends Controller
{
    use ImageHandling;

    public function description(ModelDetailRequest $request, Brand $brand, Category $category, Model $model)
    {
        if (!file_exists(public_path('storage/' . Model::CATALOG_FOLDER))) {
            mkdir(public_path('storage/' . Model::CATALOG_FOLDER), 755, true);
        }

        if ($request->file('catalog')) {
            $fileName = $request->file('catalog')->getClientOriginalName();

            $request->file('catalog')->storeAs(
                'public/' . Model::CATALOG_FOLDER, $fileName
            );

            $model->update(array_replace($request->all(), [
                'catalog'  => $fileName,
            ]));
        }

        $model->update($request->all());

        return redirect()->to(url()->previous())->with('description', 'Data is successfully updated!');
    }

    public function descImageStore(Request $request, Brand $brand, Category $category, Model $model)
    {
        $request->validate(['image' => 'required|image|max:128000']);

        $lastSort = $model->images()->where('type', 'description')->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $imgSize = config('multicraneperkasa.img-size.model-description');

        $image = $this->storeCroppedImage(
            $request->image, 
            ModelImage::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );

        $model->images()->create(['name' => $image, 'type' => 'description','sort' => $sort]);

        return response()->json(['data' => ['location' => 'description-image', 'message' => 'Data is successfully updated!']]);
    }

    public function descImageDestroy(Brand $brand, Category $category, Model $model, ModelImage $image)
    {
        $image->delete();

        return redirect()->to(url()->previous() . '#description-image')->with('description-image', 'Data is successfully deleted!');
    }

    public function descImageSort(Brand $brand, Category $category, Model $model, ModelImage $image, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchImage    = $model->images()->where('type', 'description')->where('sort', $sort, $image->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchImage) {
            $switchSort        = $switchImage->sort;
            $switchImage->sort = $image->sort;
            $switchImage->save();

            $image->sort = $switchSort;
            $image->save();
        }
        
        return redirect()->to(url()->previous() . '#description-image')->with('image', 'Data is successfully updated!');
    }
}
