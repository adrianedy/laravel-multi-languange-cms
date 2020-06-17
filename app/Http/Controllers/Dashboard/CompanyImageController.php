<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\CompanyProfileImage;
use Illuminate\Http\Request;
use App\Traits\ImageHandling;

class CompanyImageController extends Controller
{
    use ImageHandling;

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:128000',
        ]);

        $profile = CompanyProfile::first() ?? CompanyProfile::create();
        
        $lastSort = $profile->images()->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $imgSize = config('multicraneperkasa.img-size.company-profile');

        $image = $this->storeCroppedImage(
            $request->image, 
            CompanyProfileImage::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );

        $profile->images()->create(['name' => $image, 'sort' => $sort]);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(CompanyProfileImage $image)
    {
        $image->delete();

        return redirect()->to(url()->previous() . '#description-image')->with('description-image', 'Data is successfully deleted!');
    }

    public function sort(CompanyProfileImage $image, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchImage    = CompanyProfileImage::where('sort', $sort, $image->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchImage) {
            $switchSort        = $switchImage->sort;
            $switchImage->sort = $image->sort;
            $switchImage->save();

            $image->sort = $switchSort;
            $image->save();
        }
        
        return redirect()->to(url()->previous())->with('image', 'Data is successfully updated!');
    }
}
