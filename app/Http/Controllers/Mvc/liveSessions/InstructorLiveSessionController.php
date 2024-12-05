<?php

namespace App\Http\Controllers\Mvc\LiveSessions;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLiveSessionRequest;
use App\Http\Requests\UpdateLiveSessionRequest;
use App\Models\LiveSession;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;

class InstructorLiveSessionController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liveSessions = LiveSession::where('instructor_id', auth('instructor')->id())
            ->paginate(5);

        return view('live_sessions', compact('liveSessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_new_live_session');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLiveSessionRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $this->saveImage('liveSession_images', $request->validated('image'));
            $data['image'] = $image;
        }
        if ($request->hasFile('video')) {
            $video = $this->saveVideo('liveSession_videos', $request->video);
            $data['video'] = $video;
        }

        $data['instructor_id'] = auth('instructor')->id();

        $vedio = LiveSession::create($data);

        if ($vedio) {
            return redirect()->route('live-sessions.index')->with('success', 'live session uploaded successfully');
        }

        return redirect()->route('live-sessions.index')->with('error', 'Sorry, live session  can\'t be uploaded');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $liveSession = LiveSession::where('instructor_id', auth('instructor')->id())
            ->find($id);

        return view('edit_live_session', compact('liveSession'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLiveSessionRequest $request, $id)
    {
        $liveSession = LiveSession::where('instructor_id', auth('instructor')->id())->findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $this->saveImage('liveSession_images', $request->validated('image'));
            $data['image'] = $image;
        }
        if ($request->hasFile('video')) {
            $video = $this->saveVideo('liveSession_videos', $request->video);
            $data['video'] = $video;
        }

        $data['instructor_id'] = auth('instructor')->id();

        $success = $liveSession->update($data);


        if ($success) {
            return redirect()->route('live-sessions.index')->with('success', 'live session updated successfully');
        }

        return redirect()->route('live-sessions.index')->with('error', 'Sorry, live session  can\'t be updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
