<?php

namespace App\Http\Controllers;

use App\Helpers\JsonHelper;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function index(): string
    {
        $sessionList = Session::query()
            ->orderBy('date', 'DESC')
            ->with(['patients', 'session_type', 'session_type.locations'])
            ->take(5)
            ->get();
        return JsonHelper::formatResponse($sessionList, 200);
    }

    public function show(string $sessionId): string
    {
        $session = Session::query()
            ->where('id', '=', $sessionId)
            ->with(['patients', 'session_type', 'session_type.locations'])
            ->first();
        return JsonHelper::formatResponse($session);
    }
}
