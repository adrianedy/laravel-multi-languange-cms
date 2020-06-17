<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Banner;

class ApplicationController extends Controller
{
    public function show(Application $application)
    {
        $banner = Banner::where('page', $application->slug)->first();
        $appProducts = $application->products()->with('model.category.brand')->orderBy('sort')->get();
        $gallery = $application->images()->orderBy('sort')->get();

        return view('user.application')->with(compact('application', 'banner', 'appProducts', 'gallery'));
    }
}
