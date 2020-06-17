<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeSliderRequest as Request;
use App\Traits\ImageHandling;
use App\Models\HomeSlider;
use App\Http\Resources\HomeSliderResource;

class HomeSliderController extends Controller
{
    use ImageHandling;

    public function store(Request $request)
    {
        $imgSize   = config('multicraneperkasa.img-size.banner');

        $image = $this->storeCroppedImage(
            $request->image, 
            HomeSlider::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );
        
        $lastSort = HomeSlider::orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        HomeSlider::create(array_replace($request->all(), [
            'image' => $image,
            'sort'  => $sort,
        ]));

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function edit(HomeSlider $slider)
    {
        return response()->json(['data' => new HomeSliderResource($slider)]);
    }

    public function update(Request $request, HomeSlider $slider)
    {
        $update = $request->all();

        if ($request->image) {
            $slider->deleteImage();

            $imgSize   = config('multicraneperkasa.img-size.banner');
            $image = $this->storeCroppedImage(
                $request->image, 
                HomeSlider::IMAGE_FOLDER, 
                $imgSize,
                $request->image_crop                     
            );

            $update['image'] = $image;
        } else {
            $update['image'] = $slider->image;
        }

        $slider->update($update);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(HomeSlider $slider)
    {
        $slider->delete();

        return redirect()->to(url()->previous())->with('home-slider', 'Data is successfully deleted!');
    }

    public function sort(HomeSlider $slider, $sort)
    { 
        $sort         = $sort == 'up' ? '<' : '>';
        $order        = $sort == '<' ? 'desc' : 'asc';
        $switchSlider = HomeSlider::where('sort', $sort, $slider->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchSlider) {
            $switchSort         = $switchSlider->sort;
            $switchSlider->sort = $slider->sort;
            $switchSlider->save();

            $slider->sort = $switchSort;
            $slider->save();
        }
        
        return redirect()->to(url()->previous())->with('home-slider', 'Data is successfully updated!');
    }
}
