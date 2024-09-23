<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{

    public function index()
    {
        $events = Event::get();
        return response()->json([
            'events' => $events
        ]);
    }
    public function store($request)
    {
        Event::create(
            [
                'title' => $request->title,
                'start' => $request->start
            ]
        );

        return response()->json([
            'status' => 201,
            'message' => "Event Created Successfully"
        ]);
    }

    public function update($request)
    {
        $event = Event::findOrFail($request->id);

        $event->update([
            'title' => $request->title,
            'start' => $request->start
        ]);

        return response()->json([
            'status' => 201,
            'message' => "Event Updated Successfully"
        ]);
    }
    public function delete($id)
    {
        $event = Event::findOrFail($id)->delete();
        return response()->json([
            'status' => 201,
            'message' => "Event Deleted Successfully"
        ]);
    }
}
