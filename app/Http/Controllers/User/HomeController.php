<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\HomeSlider;
use App\Models\Home;
use App\Models\Equipment;

class HomeController extends Controller
{
    public function index()
    {
        $sliders    = HomeSlider::withTranslation()->orderBy('sort')->get();
        $thumbnail  = $sliders[0] ?? null;
        $home       = Home::withTranslation()->first();
        $equipments = Equipment::with('model')->orderBy('sort')->get()->groupBy('brand_name');

        return view('user.index')->with(compact('sliders', 'thumbnail', 'home', 'equipments'));
    }

    public function setLocale($lang)
    {
        App::setLocale($lang);
        Session::put('locale', $lang);
        LaravelLocalization::setLocale($lang);
        $url = LaravelLocalization::getLocalizedURL(App::getLocale(), url()->previous());

        if (strpos(url()->previous(), 'admin') !== false) {
            $url = url()->previous();
        }

        if (strpos(url()->previous(), 'set-locale') !== false) {
            $url = route('index');
        }

        return redirect()->to($url);
    }
}
