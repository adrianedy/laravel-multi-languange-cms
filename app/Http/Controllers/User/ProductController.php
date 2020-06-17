<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Model;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->brand && $request->category) {
            $brandDetail    = Brand::where('slug', $request->brand)->firstOrfail();
            $categoryDetail = $brandDetail->categories()->where('slug', $request->category)->firstOrfail();
            $products       = $categoryDetail->models;
        } else if ($request->brand) {
            $brandDetail    = Brand::where('slug', $request->brand)->firstOrfail();
            $products = Brand::where('slug', $request->brand)->firstOrfail()->models;
        } else {
            $products = Model::all();
        }
        

        return view('user.products')->with(compact('products', 'brandDetail', 'categoryDetail'));
    }

    public function show(Brand $brandDetail, Category $categoryDetail, Model $modelDetail)
    {
        $descImages     = $modelDetail->images()->where('type', 'description')->get();
        $thumbnail      = $descImages[0] ?? null;
        $specifications = $modelDetail->specifications;
        $gallery        = $modelDetail->images()->where('type', 'galery')->get();
        $testimonial    = $modelDetail->testimonies;
        $otherModels     = $categoryDetail->models;

        return view('user.product')->with(compact(
            'modelDetail', 
            'specifications', 
            'thumbnail',
            'descImages',
            'gallery',
            'testimonial',
            'otherModels'
        ));
    }
}
