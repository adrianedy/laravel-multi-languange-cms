<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class AboutUsController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page', 'about-us')->first();
        return view('dashboard.about-us')->with(compact('banner'));
    }
}
