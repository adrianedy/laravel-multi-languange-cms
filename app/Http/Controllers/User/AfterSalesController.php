<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\AfterSale;

class AfterSalesController extends Controller
{
    public function show(AfterSale $sale)
    {
        $banner = Banner::where('page', $sale->slug)->first();

        return view('user.' . $sale->slug)->with(compact('banner', 'sale'));
    }
}
