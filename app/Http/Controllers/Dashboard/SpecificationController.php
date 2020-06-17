<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecificationRequest as Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Model;
use App\Models\Specification;
use App\Http\Resources\SpecificationResource;

class SpecificationController extends Controller
{
    public function store(Request $request, Brand $brand, Category $category, Model $model)
    {
        $lastSort = $model->specifications()->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $model->specifications()->create($request->all() + ['sort' => $sort]);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function edit(Brand $brand, Category $category, Model $model, Specification $specification)
    {
        return response()->json(['data' => new SpecificationResource($specification)]);
    }

    public function update(Request $request, Brand $brand, Category $category, Model $model, Specification $specification)
    {
        $specification->update($request->all());

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(Brand $brand, Category $category, Model $model, Specification $specification)
    {
        $specification->delete();

        return redirect()->to(url()->previous() . '#specification')->with('specification', 'Data is successfully deleted!');
    }

    public function sort(Brand $brand, Category $category, Model $model, Specification $specification, $sort)
    { 
        $sort       = $sort == 'up' ? '<' : '>';
        $order      = $sort == '<' ? 'desc' : 'asc';
        $switchSpec = $model->specifications()->where('sort', $sort, $specification->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchSpec) {
            $switchSort       = $switchSpec->sort;
            $switchSpec->sort = $specification->sort;
            $switchSpec->save();

            $specification->sort = $switchSort;
            $specification->save();
        }
        
        return redirect()->to(url()->previous() . '#specification')->with('specification', 'Data is successfully updated!');
    }
}
