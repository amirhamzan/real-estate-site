<?php

namespace App\Http\Controllers;

use App\Models\AuthLog;
use Illuminate\Http\Request;

class AuthLogController extends Controller
{
    public function index()
    {
        $auth_logs = AuthLog::with('user')->latest()->paginate();

        return view('auth-logs.index', compact('auth_logs'));
    }
}
