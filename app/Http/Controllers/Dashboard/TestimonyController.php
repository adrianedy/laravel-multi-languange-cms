<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonyRequest as Request;
use App\Traits\ImageHandling;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Model;
use App\Models\Testimony;
use App\Http\Resources\TestimonyResource;

class TestimonyController extends Controller
{
    use ImageHandling;

    public function store(Request $request, Brand $brand, Category $category, Model $model)
    {
        $imgSize = config('multicraneperkasa.img-size.testimony');

        $image = $this->storeCroppedImage(
            $request->image, 
            Testimony::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );

        $model->testimonies()->create(array_replace($request->all(), [
            'image' => $image,
        ]));

        return response()->json(['data' => ['location' => 'testimonial', 'message' => 'Data is successfully updated!']]);
    }

    public function edit(Brand $brand, Category $category, Model $model, Testimony $testimony)
    {
        return response()->json(['data' => new TestimonyResource($testimony)]);
    }

    public function update(Request $request, Brand $brand, Category $category, Model $model, Testimony $testimony)
    {
        $update = $request->all();

        if ($request->image) {
            $testimony->deleteImage();

            $imgSize = config('multicraneperkasa.img-size.testimony');
            $image   = $this->storeCroppedImage(
                $request->image, 
                Testimony::IMAGE_FOLDER, 
                $imgSize,
                $request->image_crop                     
            );

            $update['image'] = $image;
        } else {
            $update['image'] = $testimony->image;
        }

        $testimony->update($update);

        return response()->json(['data' => ['location' => 'testimonial', 'message' => 'Data is successfully updated!']]);
    }

    public function destroy(Brand $brand, Category $category, Model $model, Testimony $testimony)
    {
        $testimony->delete();

        return redirect()->to(url()->previous() . '#testimonial')->with('testimonial', 'Data is successfully deleted!');
    }
}
