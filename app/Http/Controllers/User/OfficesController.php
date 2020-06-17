<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Office;

class OfficesController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page', 'offices')->first();
        $offices = Office::orderBy('sort')->get();

        return view('user.offices')->with(compact('banner', 'offices'));
    }
}
