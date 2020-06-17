<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\VideoRequest;
use App\Traits\ImageHandling;
use App\Models\Application;
use App\Models\Banner;
use App\Models\ApplicationImage;

class ApplicationDetailController extends Controller
{
    use ImageHandling;

    public function banner(BannerRequest $request, Application $application)
    {
        $banner = Banner::where('page', $application->slug)->first();

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

        Banner::updateOrCreate(['page' => $application->slug], [
            'name' => $image,
        ]);

        return redirect()->to(url()->previous())->with('banner', 'Data is successfully updated!');
    }

    public function storeImage(Request $request, Application $application)
    {
        $request->validate(['image' => 'required|image|max:128000']);

        $lastSort = $application->images()->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $imgSize = config('multicraneperkasa.img-size.galery');

        $image = $this->storeCroppedImage(
            $request->image, 
            ApplicationImage::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );

        $application->images()->create(['name' => $image, 'sort' => $sort]);

        return response()->json(['data' => ['location' => 'gallery', 'message' => 'Data is successfully updated!']]);
    }

    public function destroyImage(Application $application, ApplicationImage $image)
    {
        $image->delete();

        return redirect()->to(url()->previous() . '#gallery')->with('gallery', 'Data is successfully deleted!');
    }

    public function sortImage(Application $application, ApplicationImage $image, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchImage    = $application->images()->where('sort', $sort, $image->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchImage) {
            $switchSort        = $switchImage->sort;
            $switchImage->sort = $image->sort;
            $switchImage->save();

            $image->sort = $switchSort;
            $image->save();
        }
        
        return redirect()->to(url()->previous() . '#gallery')->with('gallery', 'Data is successfully updated!');
    }

    public function video(VideoRequest $request, Application $application)
    {
        $application->update($request->all());

        return redirect()->to(url()->previous() . '#video')->with('video', 'Data is successfully updated!');
    }
}
