<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Resources\EventsResource;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index() {
        $events = Event::with('user')->orderBy('created_at', 'desc')->paginate(10);
        if ($events) {
            return EventsResource::collection($events);
        }else{
            return response([
                'message' => 'Oops! No Events were found'
            ]);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'event_description' => 'required|string'
        ]);

        $event = new Event();
        $event->creator_id = $request->user()->id;
        $event->name = $request->name;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->event_description = $request->event_description;
        if ($request->hasFile('event_image')) {
            $event->event_image = time().'_'.$request->file('event_image')->getClientOriginalName();
            $request->file('event_image')->storeAs('images',
                time().'_'.$request->file('event_image')->getClientOriginalName(),
                'public'
            );
        }
        $event->save();
        return new EventsResource($event);
    }

    public function show($id) {
        $event = Event::where('id', $id)->with('user')->first();
        if ($event) {
            return new EventsResource($event);
        } else {
            return response([
                'message' => 'Event not found'
            ]);
        }
    }

    public function update(Event $event, Request $request){
        if ($request->hasFile('event_image')) {
            $data = [
                'name' => $request->name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'event_description' => $request->event_description,
                'event_image' => now().'_'.$request->file('event_image')->getClientOriginalName()
            ];
            $request->file('event_image')->storeAs('images',
                now().'_'.$request->file('event_image')->getClientOriginalName());
            \Storage::delete('/public/images/'.$event->event_image);
        } else {
            $data = [
                'name' => $request->name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'event_description' => $request->event_description
            ];
        }

        $event->update($data);
        return new EventsResource($event);
    }

    public function delete(Event $event) {
        $event->delete();
        return response([
            'message' => 'Event was deleted successfully'
        ]);
    }
}
