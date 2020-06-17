<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Models\Home;
use App\Models\Brand;
use App\Models\Equipment;

class DashboardController extends Controller
{
    public function index()
    {
        $sliders  = HomeSlider::withTranslation()->orderBy('sort')->get();
        $home     = Home::with('translations')->first();
        $equipments = Equipment::with('model')->orderBy('sort')->get();
        $products = Brand::with(['models' => function ($query) use ($equipments) {
            $query->whereNotIn('models.id', $equipments->pluck('model_id')->toArray());
        }])->get();
        $equipments = $equipments->groupBy('brand_name');

        return view('dashboard.index')->with(compact('sliders', 'home', 'products', 'equipments'));
    }

    public function input()
    {
        
    }
}
