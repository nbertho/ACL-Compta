<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function index()
    {
        return Session::query()
            ->orderBy('date', 'DESC')
            ->with(['patients', 'session_type', 'session_type.locations'])
            ->take(5)
            ->get();
    }

    public function show(Session $session)
    {
        return $session::query()
            ->with(['patients', 'session_type', 'session_type.locations'])
            ->get();
    }
}
