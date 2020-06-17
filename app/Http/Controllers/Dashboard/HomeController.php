<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeRequest as Request;
use App\Models\Home;
use App\Traits\ImageHandling;

class HomeController extends Controller
{
    use ImageHandling;

    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->image) {
            $imgSize   = config('multicraneperkasa.img-size.home-section');

            $image = $this->storeCroppedImage(
                $request->image, 
                Home::IMAGE_FOLDER, 
                $imgSize,
                $request->image_crop                     
            );

            $data['image'] = $image;
        } 

        Home::updateOrCreate(['id' => 1], $data);

        return redirect()->to(url()->previous())->with('first-section', 'Data is successfully updated!');
    }
}
