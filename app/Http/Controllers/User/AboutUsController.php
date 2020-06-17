<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\CompanyProfile;
use App\Models\VisionMission;

class AboutUsController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page', 'company-profile')->first();
        $about  = CompanyProfile::with(['images' => function ($query) {
            $query->orderBy('sort');
        }])->first();
        $visionMission  = VisionMission::first();

        return view('user.about-us')->with(compact('banner', 'about', 'visionMission'));
    }
}
