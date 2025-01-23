<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'event_id' => 'required|exists:events,id',
        ]);


        $event = Event::query()->findOrFail($request->event_id);
        $user = User::query()->where('email', $request->email)->first();

        if (!$user || $user->id !== $event->owner_id || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        Auth::login($user);

        return new UserResource($user);
    }
}
