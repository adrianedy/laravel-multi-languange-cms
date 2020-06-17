<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Traits\ImageHandling;
use App\Models\Banner;
use App\Models\CompanyProfile;
use App\Http\Requests\DescriptionRequest;
use App\Models\VisionMission;
use App\Http\Requests\VisionMissionRequest;

class CompanyController extends Controller
{
    use ImageHandling;

    public function index()
    {
        $banner = Banner::where('page', 'company-profile')->first();
        $profile = CompanyProfile::first();
        $visionMission = VisionMission::first();
        
        return view('dashboard.company')->with(compact('banner', 'profile', 'visionMission'));
    }

    public function storeBanner(BannerRequest $request)
    {
        $banner = Banner::where('page', 'company-profile')->first();

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

        Banner::updateOrCreate(['page' => 'company-profile'], [
            'name' => $image,
        ]);

        return redirect()->to(url()->previous())->with('banner', 'Data is successfully updated!');
    }

    public function storeDescription(DescriptionRequest $request)
    {
        CompanyProfile::updateOrCreate(['id' => 1], $request->toArray());

        return redirect()->to(url()->previous() . '#description')->with('description', 'Data is successfully updated!');
    }

    public function storeVisionMission(VisionMissionRequest $request)
    {
        $imgSize = config('multicraneperkasa.img-size.vision-mission');

        if ($request->image) {
            $image = $this->storeCroppedImage(
                $request->image, 
                VisionMission::IMAGE_FOLDER, 
                $imgSize,
                $request->image_crop                     
            );
        } else {
            $image = VisionMission::first()->image ?? null;
        }

        VisionMission::updateOrCreate(['id' => 1], array_replace($request->all(), [
            'image' => $image,
        ]));

        return redirect()->to(url()->previous() . '#vision-mission')->with('vision-mission', 'Data is successfully updated!');
    }
}
