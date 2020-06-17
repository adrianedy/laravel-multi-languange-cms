<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageHandling;
use App\Http\Requests\AfterSalesSectionRequest as Request;
use App\Http\Resources\AsSectionResource;
use App\Models\AfterSale;
use App\Models\AsSection;

class AfterSalesSectionController extends Controller
{
    use ImageHandling;

    public function store(Request $request, AfterSale $sale)
    {
        $imgSize = config('multicraneperkasa.img-size.after-sales-section');

        $image = $this->storeCroppedImage(
            $request->image, 
            AsSection::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );
        
        $lastSort = $sale->sections()->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $sale->sections()->create(array_replace($request->all(), [
            'image' => $image,
            'sort'  => $sort,
        ]));

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function edit(AfterSale $sale, AsSection $section)
    {
        return response()->json(['data' => new AsSectionResource($section)]);
    }

    public function update(Request $request, AfterSale $sale, AsSection $section)
    {
        $update = $request->all();

        if ($request->image) {
            $section->deleteImage();

            $imgSize = config('multicraneperkasa.img-size.after-sales-section');
            $image   = $this->storeCroppedImage(
                $request->image, 
                AsSection::IMAGE_FOLDER, 
                $imgSize,
                $request->image_crop                     
            );

            $update['image'] = $image;
        } else {
            $update['image'] = $section->image;
        }

        $section->update($update);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(AfterSale $sale, AsSection $section)
    {
        $section->delete();

        return redirect()->to(url()->previous() . '#sections')->with('sections', 'Data is successfully deleted!');
    }

    public function sort(AfterSale $sale, AsSection $section, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchSection  = $sale->sections()->where('sort', $sort, $section->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchSection) {
            $switchSort         = $switchSection->sort;
            $switchSection->sort  = $section->sort;
            $switchSection->save();

            $section->sort = $switchSort;
            $section->save();
        }
        
        return redirect()->to(url()->previous() . '#sections')->with('sections', 'Data is successfully updated!');
    }
}
