<?php

namespace App\Http\Controllers\Api\OnlineSesions;

use Illuminate\Http\Request;
use App\Services\ZoomService;
use App\Http\Controllers\Controller;

class ZoomController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function createMeeting(Request $request)
    {
        $accessToken = $this->zoomService->getAccessToken();

        $response = $this->zoomService->getClient()->post('https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'topic' => $request->input('topic'),
                'type' => 2, // Scheduled meeting
                'start_time' => $request->input('start_time'),
                'duration' => $request->input('duration'), // in minutes
                'timezone' => 'UTC',
            ],
        ]);

        return response()->json(json_decode($response->getBody()->getContents()), 201);
    }
}
