<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest as Request;
use App\Models\Application;
use App\Http\Resources\CategoryResource;
use App\Models\Banner;
use App\Models\Brand;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::withTranslation()->orderBy('sort')->get();

        return view('dashboard.application')->with(compact('applications'));
    }

    public function store(Request $request)
    {
        $lastSort = Application::orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        Application::create($request->all() + [
            'slug'  => strtolower(str_replace(' ', '-', $request->en['name'])),
            'sort'  => $sort,
            ]);
            
        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function show(Application $application)
    {
        $banner = Banner::where('page', $application->slug)->first();
        $gallery = $application->images()->orderBy('sort')->get();
        $appProducts = $application->products()->with('model')->orderBy('sort')->get();
        $products = Brand::with(['models' => function ($query) use ($appProducts) {
            $query->whereNotIn('models.id', $appProducts->pluck('model_id')->toArray());
        }])->get();

        return view('dashboard.application-detail')->with(compact('application', 'banner', 'gallery', 'products', 'appProducts'));
    }
        
    public function edit(Application $application)
    {
        return response()->json(['data' => new CategoryResource($application)]);
    }

    public function update(Request $request, Application $application)
    {
        $update         = $request->all();
        $update['slug'] = strtolower(str_replace(' ', '-', $request->en['name']));

        $application->update($update);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(Application $application)
    {
        foreach ($application->images as $image) {
            $image->deleteImage();
        }

        $application->delete();

        return redirect()->to(url()->previous())->with('application', 'Data is successfully deleted!');
    }

    public function sort(Application $application, $sort)
    { 
        $sort       = $sort == 'up' ? '<' : '>';
        $order      = $sort == '<' ? 'desc' : 'asc';
        $switchApp  = Application::where('sort', $sort, $application->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchApp) {
            $switchSort         = $switchApp->sort;
            $switchApp->sort    = $application->sort;
            $switchApp->save();

            $application->sort = $switchSort;
            $application->save();
        }
        
        return redirect()->to(url()->previous())->with('application', 'Data is successfully updated!');
    }
}
