<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentRequest as Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function store(Request $request)
    {
        $lastSort = Equipment::whereHas('model.category.brand', function ($query) use ($request) {
            $query->where('name', $request->brand);
        })->orderBy('sort', 'desc')->first()->sort ?? null;

        $sort = $lastSort ? $lastSort + 1 : 1;
        
        Equipment::create(['model_id' => $request->model, 'sort' => $sort]);

        return redirect()->to(url()->previous(). '#equipment-section')->with('equipment-section', 'Data is successfully updated!');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->to(url()->previous() . '#equipment-section')->with('equipment-section', 'Data is successfully deleted!');
    }

    public function sort($brand, Equipment $equipment, $sort)
    { 
        $sort            = $sort == 'up' ? '<' : '>';
        $order           = $sort == '<' ? 'desc' : 'asc';
        $switchEquipment = Equipment::whereHas('model.category.brand', function ($query) use ($brand) {
            $query->where('name', $brand);
        })->where('sort', $sort, $equipment->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchEquipment) {
            $switchSort            = $switchEquipment->sort;
            $switchEquipment->sort = $equipment->sort;
            $switchEquipment->save();

            $equipment->sort = $switchSort;
            $equipment->save();
        }
        
        return redirect()->to(url()->previous() . '#equipment-section')->with('equipment-section', 'Data is successfully updated!');
    }
}
