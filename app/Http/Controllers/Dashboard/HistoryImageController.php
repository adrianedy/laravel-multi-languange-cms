<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use Image;
use App\Traits\ImageHandling;
use App\Models\HistoryImage;

class HistoryImageController extends Controller
{
    use ImageHandling;

    public function store(Request $request, History $history)
    {
        $request->validate(['image' => 'required|image|max:128000']);

        $name = $this->storeImage($request->image, HistoryImage::IMAGE_FOLDER);

        $lastSort = $history->images()->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $history->images()->create(['name' => $name, 'sort' => $sort]);

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(History $history, HistoryImage $image)
    {
        $image->delete();

        return redirect()->to(url()->previous())->with('image', 'Data is successfully deleted!');
    }
    
    public function sort(History $history, HistoryImage $image, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchImage    = $history->images()->where('sort', $sort, $image->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchImage) {
            $switchSort        = $switchImage->sort;
            $switchImage->sort = $image->sort;
            $switchImage->save();

            $image->sort = $switchSort;
            $image->save();
        }
        
        return redirect()->to(url()->previous())->with('image', 'Data is successfully updated!');
    }
}
