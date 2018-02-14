<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class EventController extends Controller
{
    public function postEvent(Request $request)
    {
// TO DO: validate user or get group_id and user_id
        // validating the request
        $this->validate($request, [
            'event_type_id' => 'required',
            'group_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'published' => 'required'
        ]);

        $event = new Event([
            'event_type_id' => $request->input('event_type_id'),
            'group_id' => $request->input('group_id'),
            'user_id' => $request->input('user_id'),
            'last_updated_by' => $request->input('last_updated_by'),
            'published' => $request->input('published'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'allDay' => $request->input('all_day'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'url' => $request->input('url'),
            'className' => $request->input('class_name'),
            'editable' => $request->input('editable'),
            'startEditable' => $request->input('start_editable'),
            'durationEditable' => $request->input('duration_editable'),
            'recourceEditable' => $request->input('resource_editable'),
            'rendering' => $request->input('rendering'),
            'overlap' => $request->input('overlap'),
            'constraint' => $request->input('constraint'),
            'source' => $request->input('source'),
            'color' => $request->input('color'),
            'backgroundColor' => $request->input('backgroundColor'),
            'borderColor' => $request->input('borderColor'),
            'textColor' => $request->input('textColor'),
        ]);
        $event->save();
        return response()->json(['event' => $event], 201);
    }

    public function getEvent($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $response = [
            'event' => $event
        ];
        return response()->json($response, 200);
    }

    public function getEvents()
    {
        $events = Event::all();
        $response = [
            'events' => $events
        ];
        return response()->json($response, 200);
    }

    public function getGroupEvents($id)
    {
        $events = Event::where('group_id', $id)
            ->orderBy('start', 'asc')
            ->get();
        if (!$events) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $response = [
            'events' => $events
        ];
        return response()->json($response, 200);
    }

    public function putEvent(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Document not found'], 404);
        }
// TO DO: differentiate the admin from a regular user
        $event->update([
            'event_type_id' => $request->input('event_type_id'),
            'group_id' => $request->input('group_id'),
            'user_id' => $request->input('user_id'),
            'last_updated_by' => $request->input('last_updated_by'),
            'published' => $request->input('published'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'allDay' => $request->input('all_day'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'url' => $request->input('url'),
            'className' => $request->input('class_name'),
            'editable' => $request->input('editable'),
            'startEditable' => $request->input('start_editable'),
            'durationEditable' => $request->input('duration_editable'),
            'recourceEditable' => $request->input('resource_editable'),
            'rendering' => $request->input('rendering'),
            'overlap' => $request->input('overlap'),
            'constraint' => $request->input('constraint'),
            'source' => $request->input('source'),
            'color' => $request->input('color'),
            'backgroundColor' => $request->input('backgroundColor'),
            'borderColor' => $request->input('borderColor'),
            'textColor' => $request->input('textColor'),
        ]);
        return response()->json(['event' => $event], 200);
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $event->delete();
        return response()->json(['message' => 'Event deleted.'], 200);
    }

    public function publishEvent($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $event->update(['published' => true]);
        return response()->json(['event' => $event], 200);
    }

    public function unpublishEvent($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $event->update(['published' => false]);
        return response()->json(['event' => $event], 200);
    }

    public function getImages($id){
        $event = Event::findorfail($id);
        $images = $event->images;
        $response = [
            'images' => $images
        ];
        return response()->json($response, 200);
    }
}
