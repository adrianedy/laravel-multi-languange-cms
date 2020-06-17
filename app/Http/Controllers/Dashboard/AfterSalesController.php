<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageHandling;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\DescriptionRequest;
use App\Models\AfterSale;
use App\Models\Banner;

class AfterSalesController extends Controller
{
    use ImageHandling;

    public function index(AfterSale $sale)
    {
        $sections = $sale->sections()->orderBy('sort')->get();

        return view('dashboard.after-sales')->with(compact('sale', 'sections'));
    }

    public function banner()
    {
        $banner = Banner::where('page', 'after-sales')->first();

        return view('dashboard.after-sales-banner')->with(compact('banner'));
    }

    public function storeBanner(BannerRequest $request)
    {
        $banner = Banner::where('page', 'after-sales')->first();

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

        Banner::updateOrCreate(['page' => 'after-sales'], [
            'name' => $image,
        ]);

        return redirect()->to(url()->previous())->with('banner', 'Data is successfully updated!');
    } 

    public function storeDescription(AfterSale $sale, DescriptionRequest $request)
    {
        $sale->update($request->toArray());

        return redirect()->to(url()->previous())->with('description', 'Data is successfully updated!');
    }
}
