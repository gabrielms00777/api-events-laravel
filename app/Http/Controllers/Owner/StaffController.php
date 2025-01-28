<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $event = Event::query()->find(
            $request->user()->last_event_id
        );
        return UserResource::collection(
            $event->staff()->latest()->get()
        );
    }
}
