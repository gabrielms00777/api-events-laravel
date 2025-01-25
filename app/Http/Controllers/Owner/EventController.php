<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        return EventResource::collection($request
            ->user()
            ->events()
            ->latest()
            ->get());
    }
    public function show(Request $request)
    {
        $user = $request->user();

        if ($user->last_event_id) {
            return new EventResource(Event::find($user->last_event_id));
        }

        $user->update([
            'last_event_id' => $user->events()->latest()->first()->id
        ]);

        return new EventResource($user->events()->latest()->first());
    }

    public function selectEvent(Request $request)
    {
        $event = Event::query()->where('id', $request->event_id)->where('owner_id', $request->user()->id)->first();
        if ($event) {
            $request->user()->update([
                'last_event_id' => $event->id
            ]);
            return new EventResource($event);
        }
        return response()->json(['message' => 'Event not found'], 404);

    }
}
