<?php

namespace App\Http\Controllers\Api\LiveSessions;

use App\Http\Controllers\Controller;
use App\Models\LiveSession;
use Illuminate\Http\Request;

class LiveSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liveSessions = LiveSession::where('status', 'active')
            ->select('id', 'title', 'description', 'image', 'instructor_id')
            ->with('instructor:id,name')
            ->get();

        if ($liveSessions->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'There is no active live session',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'all data quired successfully',
            'data' => $liveSessions
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $liveSession = LiveSession::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'the live session quired successfully',
            'data' => $liveSession
        ]);
    }
}
