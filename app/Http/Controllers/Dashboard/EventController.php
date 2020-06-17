<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest as Request;
use App\Models\History;
use App\Models\Event;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    public function store(Request $request, History $history)
    {
        $lastSort = $history->events()->orderBy('sort', 'desc')->first()->sort ?? null;
        $sort = $lastSort ? $lastSort + 1 : 1;

        $history->events()->create(array_replace($request->all(), ['sort' => $sort]));

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function edit(History $history, Event $event)
    {
        return response()->json(['data' => new EventResource($event)]);
    }

    public function update(Request $request, History $history, Event $event)
    {
        $event->update($request->toArray());

        return response()->json(['data' => ['message' => 'Data is successfully updated!']]);
    }

    public function destroy(History $history, Event $event)
    {
        $event->delete();

        return redirect()->to(url()->previous())->with('event', 'Data is successfully deleted!');
    }

    public function sort(History $history, Event $event, $sort)
    { 
        $sort           = $sort == 'up' ? '<' : '>';
        $order          = $sort == '<' ? 'desc' : 'asc';
        $switchEvent = $history->events()->where('sort', $sort, $event->sort)->orderBy('sort', $order)->first() ?? null;

        if ($switchEvent) {
            $switchSort             = $switchEvent->sort;
            $switchEvent->sort   = $event->sort;
            $switchEvent->save();

            $event->sort = $switchSort;
            $event->save();
        }
        
        return redirect()->to(url()->previous())->with('event', 'Data is successfully updated!');
    }
}
