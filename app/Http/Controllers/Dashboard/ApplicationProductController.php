<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationProduct;

class ApplicationProductController extends Controller
{
    public function store(Request $request, Application $application)
    {
        $lastSort = $application->products()->orderBy('sort', 'desc')->first()->sort ?? null;

        $sort = $lastSort ? $lastSort + 1 : 1;
        
        $application->products()->create(['model_id' => $request->model, 'sort' => $sort]);

        return redirect()->to(url()->previous(). '#products')->with('products', 'Data is successfully updated!');
    }

    public function destroy(Application $application, ApplicationProduct $product)
    {
        $product->delete();

        return redirect()->to(url()->previous() . '#products')->with('products', 'Data is successfully deleted!');
    }

    public function sort(Application $application, ApplicationProduct $product, $sort)
    { 
        $sort          = $sort == 'up' ? '<' : '>';
        $order         = $sort == '<' ? 'desc' : 'asc';
        $switchProduct = $application->products()->where('sort', $sort, $product->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchProduct) {
            $switchSort          = $switchProduct->sort;
            $switchProduct->sort = $product->sort;
            $switchProduct->save();

            $product->sort = $switchSort;
            $product->save();
        }
        
        return redirect()->to(url()->previous() . '#products')->with('products', 'Data is successfully updated!');
    }
}
