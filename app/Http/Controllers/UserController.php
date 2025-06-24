<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (!Gate::allows('view-users')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return User::select('id', 'name', 'email', 'role', 'status')->get();
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'status' => $request->status ?? true
        ]);

        return response()->json($user);
    }
}

