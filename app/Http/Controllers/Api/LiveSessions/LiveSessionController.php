<?php

namespace App\Http\Controllers\Api\LiveSessions;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\LiveSession;
use Illuminate\Http\Request;

class LiveSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::whereHas('liveSeesions')->paginate(10);
        // $instructors->load('liveSeesions');

        if ($instructors->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'There is no active live session',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'all data quired successfully',
            'instructors' => $instructors
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->load('liveSeesions');
        return response()->json([
            'status'        => true,
            'message'       => 'the live session quired successfully',
            'data'          => $instructor,

        ]);
    }
}
