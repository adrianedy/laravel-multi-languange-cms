<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Traits\ImageHandling;
use App\Models\History;

class HistoryController extends Controller
{
    use ImageHandling;

    public function index()
    {
        $banner = Banner::where('page', 'history')->first();
        $histories = History::orderBy('year')->get();

        return view('dashboard.history')->with(compact('banner', 'histories'));
    }

    public function show(History $history)
    {
        $events = $history->events()->orderBy('sort')->get();
        $images = $history->images()->orderBy('sort')->get();
        return view('dashboard.events')->with(compact('history', 'events', 'images'));
    }

    public function storeBanner(BannerRequest $request)
    {
        $banner = Banner::where('page', 'history')->first();

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

        Banner::updateOrCreate(['page' => 'history'], [
            'name' => $image,
        ]);

        return redirect()->to(url()->previous())->with('banner', 'Data is successfully updated!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|unique:histories,year',
        ]);

        History::create($request->toArray());

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function edit(History $history)
    {
        return response()->json(['data' => ['year' => $history->year]]);
    }

    public function update(Request $request, History $history)
    {
        $request->validate([
            'year' => 'numeric|unique:histories,year',
        ]);

        $history->update($request->toArray());

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(History $history)
    {
        foreach ($history->images as $image) {
            $image->deleteImage();
        }
        
        $history->delete();

        return redirect()->to(url()->previous())->with('history', 'Data is successfully deleted!');
    }
}
