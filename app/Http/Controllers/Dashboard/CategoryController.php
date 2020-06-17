<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest as Request;
use App\Traits\ImageHandling;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use ImageHandling;

    public function index(Brand $brand)
    {
        $categories = $brand->categories()->orderBy('sort')->get();

        return view('dashboard.category')->with(compact('brand', 'categories'));
    }

    public function store(Request $request, Brand $brand)
    {        
        $lastSort = $brand->categories()->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $brand->categories()->create(array_replace($request->all(), [
            'slug'  => strtolower(str_replace(' ', '-', $request->en['name'])),
            'sort'  => $sort,
        ]));

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function edit($brand, Category $category)
    {
        return response()->json(['data' => new CategoryResource($category)]);
    }

    public function update(Request $request, $brand, Category $category)
    {
        $update         = $request->all();
        $update['slug'] = strtolower(str_replace(' ', '-', $request->en['name']));

        $category->update($update);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy($brand, Category $category)
    {
        $category->delete();

        return redirect()->to(url()->previous())->with('category', 'Data is successfully deleted!');
    }

    public function sort($brand, Category $category, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchCategory = Category::where('sort', $sort, $category->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchCategory) {
            $switchSort             = $switchCategory->sort;
            $switchCategory->sort   = $category->sort;
            $switchCategory->save();

            $category->sort = $switchSort;
            $category->save();
        }
        
        return redirect()->to(url()->previous())->with('category', 'Data is successfully updated!');
    }
}
