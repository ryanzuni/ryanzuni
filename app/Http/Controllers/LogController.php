<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class LogController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return ActivityLog::with('user:id,name')->latest('logged_at')->get();
    }
}

