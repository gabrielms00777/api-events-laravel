<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateEventRequest;
use App\Http\Requests\Admin\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\User;
use App\Notifications\WelcomeOwnerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::query()->latest()->take(5)->get();
        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request)
    {
        $data = $request->validated();

        $owner = User::query()->firstOrCreate([
            'email' => $data['owner']['email']
        ], [
            'name' => $data['owner']['name'],
            'role' => 'event_owner',
            'password' => Hash::make($password = Str::random(10))
        ]);

        $event = Event::query()->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'location' => $data['location'],
            'max_participants' => $data['max_participants'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        $event->owners()->attach($owner->id, ['role' => 'owner']);

        $owner->notify(new WelcomeOwnerNotification($event, $password));

        return new EventResource($event->load('owners'));



        // $event = Event::create($request->validated());
        // return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->noContent(); // or return response()->json(['message' => 'Event deleted successfully']);
    }

    public function sendLink(Event $event)
    {
        
    }
}
