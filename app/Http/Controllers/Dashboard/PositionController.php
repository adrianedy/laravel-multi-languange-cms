<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest as Request;
use App\Models\Position;
use App\Http\Resources\PositionResource;

class PositionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $deadline = date('Y-m-d', strtotime($request->deadline));
        Position::create(array_replace($request->all(), [
            'deadline' => $deadline,
            'slug'  => strtolower(str_replace(' ', '-', $request->name)),
        ]));

        return response()->json(['data' => ['location' => '#position', 'message' => 'Data is successfully updated!']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return response()->json(['data' => new PositionResource($position)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $deadline = date('Y-m-d', strtotime($request->deadline));
        $position->update(array_replace($request->all(), [
            'deadline' => $deadline,
            'slug'  => strtolower(str_replace(' ', '-', $request->name)),
        ]));

        return response()->json(['data' => ['location' => '#position', 'message' => 'Data is successfully updated!']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();
        
        return redirect()->to(url()->previous() . '#position')->with('position', 'Data is successfully deleted!');
    }
}
