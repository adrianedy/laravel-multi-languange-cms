<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Application;
use App\Models\Brand;
use App\Models\AfterSale;

class UserPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $products     = Brand::with('categories.models')->get();
        $applications = Application::all();
        $afterSales   = AfterSale::all();

        view()->share('productsNav', $products);
        view()->share('applications', $applications);
        view()->share('afterSales', $afterSales);
        
        return $next($request);
    }
}
