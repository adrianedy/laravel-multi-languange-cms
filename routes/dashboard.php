<?php

/*
|--------------------------------------------------------------------------
| Web Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application dashboard. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web", "auth" and "dashboard" middleware group, "/Dashboard" namespace suffix 
| "admin" url prefix, and "dashboard." for the naming prefix. 
| Now create something great!
|
*/

Route::get('/', 'DashboardController@index')->name('index');

Route::group(['as' => 'home-slider.', 'prefix' => 'home-slider'], function () {
    Route::post('/', 'HomeSliderController@store')->name('store');
    Route::get('/{slider}/edit', 'HomeSliderController@edit')->name('edit');
    Route::patch('/{slider}', 'HomeSliderController@update')->name('update');
    Route::delete('/{slider}', 'HomeSliderController@destroy')->name('destroy');
    Route::post('/{slider}/sort/{sort}', 'HomeSliderController@sort')->name('sort');
});

Route::post('home', 'HomeController@update')->name('home.update');

Route::group(['as' => 'equipment.', 'prefix' => 'equipment'], function () {
    Route::post('/', 'EquipmentController@store')->name('store');
    Route::delete('/{equipment}', 'EquipmentController@destroy')->name('destroy');
    Route::post('/{brand}/{equipment}/sort/{sort}', 'EquipmentController@sort')->name('sort');
});

// Route::group(['as' => 'application.', 'prefix' => 'application'], function () {
//     Route::get('/', 'ApplicationController@index')->name('index');
//     Route::post('/', 'ApplicationController@store')->name('store');
//     Route::get('/{application}/detail', 'ApplicationController@show')->name('show');
//     Route::get('/{application}/edit', 'ApplicationController@edit')->name('edit');
//     Route::patch('/{application}', 'ApplicationController@update')->name('update');
//     Route::delete('/{application}', 'ApplicationController@destroy')->name('destroy');
//     Route::post('/{application}/sort/{sort}', 'ApplicationController@sort')->name('sort');

//     Route::group(['as' => 'detail.', 'prefix' => '{application}/detail'], function () {
//         Route::post('/banner', 'ApplicationDetailController@banner')->name('banner');

//         Route::group(['as' => 'product.', 'prefix' => 'product'], function () {
//             Route::post('/', 'ApplicationProductController@store')->name('store');
//             Route::delete('/{product}', 'ApplicationProductController@destroy')->name('destroy');
//             Route::post('/{product}/sort/{sort}', 'ApplicationProductController@sort')->name('sort');
//         });

//         Route::post('/video', 'ApplicationDetailController@video')->name('video');

//         Route::group(['as' => 'gallery.', 'prefix' => 'gallery'], function () {
//             Route::post('/', 'ApplicationDetailController@storeImage')->name('store');
//             Route::delete('/{image}', 'ApplicationDetailController@destroyImage')->name('destroy');
//             Route::post('/{image}/sort/{sort}', 'ApplicationDetailController@sortImage')->name('sort');
//         });
//     });
// });

// Route::group(['as' => 'brand.', 'prefix' => 'products'], function () {
//     Route::get('/', 'BrandController@index')->name('index');
//     Route::post('/', 'BrandController@store')->name('store');
//     Route::get('/{brand}/edit', 'BrandController@edit')->name('edit');
//     Route::patch('/{brand}', 'BrandController@update')->name('update');
//     Route::delete('/{brand}', 'BrandController@destroy')->name('destroy');
//     Route::post('/{brand}/sort/{sort}', 'BrandController@sort')->name('sort');
    
//     Route::group(['as' => 'category.', 'prefix' => '{brand}'], function () {
//         Route::get('/categories', 'CategoryController@index')->name('index');
//         Route::post('/', 'CategoryController@store')->name('store');
//         Route::get('/{category}/edit', 'CategoryController@edit')->name('edit');
//         Route::patch('/{category}', 'CategoryController@update')->name('update');
//         Route::delete('/{category}', 'CategoryController@destroy')->name('destroy');
//         Route::post('/{category}/sort/{sort}', 'CategoryController@sort')->name('sort');

//         Route::group(['as' => 'model.', 'prefix' => '{category}'], function () {
//             Route::get('/models', 'ModelController@index')->name('index');
//             Route::get('/{model}/detail', 'ModelController@show')->name('show');
//             Route::get('/{model}/edit', 'ModelController@edit')->name('edit');
//             Route::post('/', 'ModelController@store')->name('store');
//             Route::patch('/{model}', 'ModelController@update')->name('update');
//             Route::delete('/{model}', 'ModelController@destroy')->name('destroy');

//             Route::group(['as' => 'detail.', 'prefix' => '{model}/detail'], function () {
//                 Route::post('/description', 'ModelDetailController@description')->name('description');
//                 Route::group(['as' => 'description-image.', 'prefix' => 'description-image'], function () {
//                     Route::post('/', 'ModelDetailController@descImageStore')->name('store');
//                     Route::delete('/{image}', 'ModelDetailController@descImageDestroy')->name('destroy');
//                     Route::post('/{image}/sort/{sort}', 'ModelDetailController@descImageSort')->name('sort');
//                 });

//                 Route::group(['as' => 'specification.', 'prefix' => 'specification'], function () {
//                     Route::post('/', 'SpecificationController@store')->name('store');
//                     Route::get('/{specification}/edit', 'SpecificationController@edit')->name('edit');
//                     Route::patch('/{specification}', 'SpecificationController@update')->name('update');
//                     Route::delete('/{specification}', 'SpecificationController@destroy')->name('destroy');
//                     Route::post('/{specification}/sort/{sort}', 'SpecificationController@sort')->name('sort');
//                 });

//                 Route::group(['as' => 'galery.', 'prefix' => 'galery'], function () {
//                     Route::post('/', 'ModelGaleryController@store')->name('store');
//                     Route::get('/{image}/edit', 'ModelGaleryController@edit')->name('edit');
//                     Route::delete('/{image}', 'ModelGaleryController@destroy')->name('destroy');
//                     Route::post('/{image}/sort/{sort}', 'ModelGaleryController@sort')->name('sort');
//                 });

//                 Route::group(['as' => 'testimony.', 'prefix' => 'testimony'], function () {
//                     Route::post('/', 'TestimonyController@store')->name('store');
//                     Route::get('/{testimony}/edit', 'TestimonyController@edit')->name('edit');
//                     Route::patch('/{testimony}', 'TestimonyController@update')->name('update');
//                     Route::delete('/{testimony}', 'TestimonyController@destroy')->name('destroy');
//                     Route::post('/{testimony}/sort/{sort}', 'TestimonyController@sort')->name('sort');
//                 });
//             });
//         });
//     });
// });

// Route::group(['as' => 'after-sales.', 'prefix' => 'after-sales'], function () {
//     Route::get('/', 'AfterSalesController@banner')->name('banner.index');
//     Route::post('/banner', 'AfterSalesController@storeBanner')->name('banner.store');
    
//     Route::group(['prefix' => '{sale}'], function () {
//         Route::get('/', 'AfterSalesController@index')->name('index');
//         Route::post('/description', 'AfterSalesController@storeDescription')->name('description.store');

//         Route::group(['as' => 'section.', 'prefix' => 'section'], function () {
//             Route::post('/', 'AfterSalesSectionController@store')->name('store');
//             Route::get('/{section}/edit', 'AfterSalesSectionController@edit')->name('edit');
//             Route::patch('/{section}', 'AfterSalesSectionController@update')->name('update');
//             Route::delete('/{section}', 'AfterSalesSectionController@destroy')->name('destroy');
//             Route::post('/{section}/sort/{sort}', 'AfterSalesSectionController@sort')->name('sort');
//         });
//     });
// });

// Route::group(['as' => 'career.', 'prefix' => 'career'], function () {
//     Route::get('/', 'CareerController@index')->name('index');
//     Route::post('/banner', 'CareerController@banner')->name('banner');
//     Route::post('/first-section', 'CareerController@firstSection')->name('first-section');

//     Route::group(['as' => 'position.', 'prefix' => 'position'], function () {
//         Route::post('/', 'PositionController@store')->name('store');
//         Route::get('/{position}/edit', 'PositionController@edit')->name('edit');
//         Route::patch('/{position}', 'PositionController@update')->name('update');
//         Route::delete('/{position}', 'PositionController@destroy')->name('destroy');
//     });

//     Route::get('/applicant', 'ApplicantController@index')->name('applicant.index');
//     Route::get('/applicant/{applicant}', 'ApplicantController@show')->name('applicant.show');
// });

// Route::group(['as' => 'about-us.', 'prefix' => 'about-us'], function () {
//     // Route::get('/', 'AboutUsController@index')->name('index');

//     Route::group(['as' => 'company-profile.', 'prefix' => 'company-profile'], function () {
//         Route::get('/', 'CompanyController@index')->name('index');
//         Route::post('/banner', 'CompanyController@storeBanner')->name('banner.store');

//         Route::group(['as' => 'description-image.', 'prefix' => 'description-image'], function () {
//             Route::post('/', 'CompanyImageController@store')->name('store');
//             Route::delete('/{image}', 'CompanyImageController@destroy')->name('destroy');
//             Route::post('/{image}/sort/{sort}', 'CompanyImageController@sort')->name('sort');
//         });

//         Route::post('/description', 'CompanyController@storeDescription')->name('description.store');
//         Route::post('/vision-mission', 'CompanyController@storeVisionMission')->name('vision-mission.store');
//     });

//     Route::group(['as' => 'history.', 'prefix' => 'history'], function () {
//         Route::get('/', 'HistoryController@index')->name('index');
//         Route::post('/banner', 'HistoryController@storeBanner')->name('banner.store');
//         Route::post('/', 'HistoryController@store')->name('store');
//         Route::get('/{history}/edit', 'HistoryController@edit')->name('edit');
//         Route::patch('/{history}', 'HistoryController@update')->name('update');
//         Route::delete('/{history}', 'HistoryController@destroy')->name('destroy');
        
//         Route::get('/{history}', 'HistoryController@show')->name('show');
//         Route::group(['as' => 'event.', 'prefix' => '{history}/event'], function () {
//             Route::post('/', 'EventController@store')->name('store');
//             Route::get('/{event}/edit', 'EventController@edit')->name('edit');
//             Route::patch('/{event}', 'EventController@update')->name('update');
//             Route::delete('/{event}', 'EventController@destroy')->name('destroy');
//             Route::post('/{event}/sort/{sort}', 'EventController@sort')->name('sort');
//         });
//         Route::group(['as' => 'image.', 'prefix' => '{history}/image'], function () {
//             Route::post('/', 'HistoryImageController@store')->name('store');
//             Route::get('/{image}/edit', 'HistoryImageController@edit')->name('edit');
//             Route::patch('/{image}', 'HistoryImageController@update')->name('update');
//             Route::delete('/{image}', 'HistoryImageController@destroy')->name('destroy');
//             Route::post('/{image}/sort/{sort}', 'HistoryImageController@sort')->name('sort');
//         });
//         // Route::get('/enviroment', 'EnviromentController@index')->name('enviroment.index');
//     });
// });

// Route::group(['as' => 'offices.', 'prefix' => 'offices'], function () {
//     Route::post('/banner', 'OfficeController@storeBanner')->name('banner.store');
    
//     Route::get('/', 'OfficeController@index')->name('index');
//     Route::post('/', 'OfficeController@store')->name('store');
//     Route::get('/{office}/edit', 'OfficeController@edit')->name('edit');
//     Route::patch('/{office}', 'OfficeController@update')->name('update');
//     Route::delete('/{office}', 'OfficeController@destroy')->name('destroy');
//     Route::post('/{office}/sort/{sort}', 'OfficeController@sort')->name('sort');
// });