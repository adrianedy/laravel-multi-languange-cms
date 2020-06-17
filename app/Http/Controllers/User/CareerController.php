<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Banner;
use App\Models\Position;

class CareerController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page', 'career')->first();
        $career = Career::first();
        $positions = Position::all();

        return view('user.career')->with(compact('banner', 'career', 'positions'));
    }

    public function show(Position $position)
    {
        $banner = Banner::where('page', 'career')->first();

        return view('user.career-detail')->with(compact('banner', 'position'));
    }
}
