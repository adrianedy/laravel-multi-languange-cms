<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeRequest as Request;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Traits\ImageHandling;
use App\Models\Office;
use App\Http\Resources\OfficeResource;

class OfficeController extends Controller
{
    use ImageHandling;
    
    public function index()
    {
        $banner = Banner::where('page', 'offices')->first();
        $offices = Office::orderBy('sort')->get();

        return view('dashboard.offices')->with(compact('banner', 'offices'));
    }

    public function store(Request $request)
    {
        $lastSort = Office::orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        Office::create($request->all() + ['sort' => $sort]);
        
        return response()->json(['data' => ['location' => 'location', 'message' => 'Data is successfully updated!']]);
    }

    public function edit(Office $office)
    {
        return response()->json(['data' => new OfficeResource($office)]);
    }

    public function update(Request $request, Office $office)
    {
        $office->update($request->all());

        return response()->json(['data' => ['location' => 'location', 'message' => 'Data is successfully updated!']]);
    }

    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->to(url()->previous() . '#location')->with('office', 'Data is successfully deleted!');
    }

    public function sort(Office $office, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchOffice   = $office->where('sort', $sort, $office->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchOffice) {
            $switchSort         = $switchOffice->sort;
            $switchOffice->sort = $office->sort;
            $switchOffice->save();

            $office->sort = $switchSort;
            $office->save();
        }
        
        return redirect()->to(url()->previous() . '#location')->with('office', 'Data is successfully updated!');
    }

    public function storeBanner(BannerRequest $request)
    {
        $banner = Banner::where('page', 'offices')->first();

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

        Banner::updateOrCreate(['page' => 'offices'], [
            'name' => $image,
        ]);

        return redirect()->to(url()->previous())->with('banner', 'Data is successfully updated!');
    }
}
