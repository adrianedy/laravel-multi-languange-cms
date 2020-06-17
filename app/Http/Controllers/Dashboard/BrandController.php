<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageHandling;
use App\Http\Requests\BrandRequest as Request;
use App\Models\Brand;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    use ImageHandling;

    public function index()
    {
        $brands = Brand::orderBy('sort')->get();

        return view('dashboard.product')->with(compact('brands'));
    }

    public function store(Request $request)
    {
        $imgSize = config('multicraneperkasa.img-size.brand');

        $image = $this->storeCroppedImage(
            $request->image, 
            Brand::IMAGE_FOLDER, 
            $imgSize,
            $request->image_crop                     
        );
        
        $lastSort = Brand::orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        Brand::create(array_replace($request->all(), [
            'image' => $image,
            'slug'  => strtolower(str_replace(' ', '-', $request->name)),
            'sort'  => $sort,
        ]));

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function edit(Brand $brand)
    {
        return response()->json(['data' => new BrandResource($brand)]);
    }

    public function update(Request $request, Brand $brand)
    {
        $update = $request->all();

        if ($request->image) {
            $brand->deleteImage();

            $imgSize = config('multicraneperkasa.img-size.brand');
            $image   = $this->storeCroppedImage(
                $request->image, 
                Brand::IMAGE_FOLDER, 
                $imgSize,
                $request->image_crop                     
            );

            $update['image'] = $image;
        } else {
            $update['image'] = $brand->image;
        }

        $brand->update($update);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->to(url()->previous())->with('brand', 'Data is successfully deleted!');
    }

    public function sort(Brand $brand, $sort)
    { 
        $sort        = $sort == 'up' ? '<' : '>';
        $order       = $sort == '<' ? 'desc' : 'asc';
        $switchBrand = Brand::where('sort', $sort, $brand->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchBrand) {
            $switchSort         = $switchBrand->sort;
            $switchBrand->sort  = $brand->sort;
            $switchBrand->save();

            $brand->sort = $switchSort;
            $brand->save();
        }
        
        return redirect()->to(url()->previous())->with('brand', 'Data is successfully updated!');
    }
}
