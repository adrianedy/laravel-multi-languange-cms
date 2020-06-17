<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Auth::routes(['register' => false]);
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'user.page' ],
    'namespace' => 'User',
], function() {
    Route::get('set-locale/{lang}', 'HomeController@setLocale')->name('set-locale');

    Route::get('/', 'HomeController@index')->name('index');
    // Route::get('application/{application}', 'ApplicationController@show')->name('application');
    // Route::get('product', 'ProductController@index')->name('product.index');
    // Route::get('product/{brandDetail}/{categoryDetail}/{modelDetail}', 'ProductController@show')->name('product.show');
    // Route::get('after-sales/{sale}', 'AfterSalesController@show')->name('after-sales');
    // Route::get('career', 'CareerController@index')->name('career.index');
    // Route::get('career/{position}', 'CareerController@show')->name('career.show');
    // Route::post('career', 'CareerController@apply')->name('career.apply');
    // Route::get('about-us', 'AboutUsController@index')->name('about-us');
    // Route::get('history', 'AboutUsController@history')->name('about-us.history');
    // Route::get('offices', 'OfficesController@index')->name('offices');
});
