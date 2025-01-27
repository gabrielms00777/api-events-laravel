<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckAuthRole extends Controller
{
    public function __invoke(Request $request, string $role)
    {
        if ($request->user()->role !== $role) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->noContent();
    }
}
