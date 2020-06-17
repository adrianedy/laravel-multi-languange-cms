<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Traits\ImageHandling;
use App\Http\Requests\CareerRequest;
use App\Models\Career;
use App\Models\Position;

class CareerController extends Controller
{
    use ImageHandling;

    public function index()
    {
        $banner     = Banner::where('page', 'career')->first();
        $career     = Career::first();
        $positions  = Position::all();

        return view('dashboard.career')->with(compact('banner', 'career', 'positions'));
    }

    public function banner(BannerRequest $request)
    {
        $banner = Banner::where('page', 'career')->first();

        if ($banner) {
            $banner->deleteImage();
        }

        $imgSize = config('multicraneperkasa.img-size.banner');

        $image = $this->storeCroppedImage(
            $request->image, 
            Banner::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );

        Banner::updateOrCreate(['page' => 'career'], [
            'name' => $image,
        ]);

        return redirect()->to(url()->previous())->with('banner', 'Data is successfully updated!');
    }

    public function firstSection(CareerRequest $request)
    {
        $imgSize = config('multicraneperkasa.img-size.career');

        if ($request->image) {
            $image = $this->storeCroppedImage(
                $request->image, 
                Career::IMAGE_FOLDER, 
                $imgSize,
                $request->image_crop                     
            );
        } else {
            $image = Career::first()->image ?? null;
        }

        Career::updateOrCreate(['id' => 1], array_replace($request->all(), [
            'image' => $image,
        ]));

        return redirect()->to(url()->previous() . '#first-section')->with('first-section', 'Data is successfully updated!');
    }
}
