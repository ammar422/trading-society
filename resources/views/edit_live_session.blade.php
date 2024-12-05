@extends('layouts.master')
@section('title', 'Trading Society')
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Live Session</h4>
                <p class="card-description"> Please enter live session information </p>
                <form class="forms-sample" action="{{ route('live-sessions.update', $liveSession->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Live Session Title" value="{{ $liveSession->title }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" cols="30"
                            rows="10" placeholder="Live Session Description">{{ $liveSession->description }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration (in minutes)</label>
                        <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror"
                            id="duration" placeholder="Live Session Duration" value="{{ $liveSession->duration }}">
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="video">Video</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="video" class="form-control @error('video') is-invalid @enderror">
                            @error('video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                            value="{{ old('status') }}">
                            <option value="active" @selected($liveSession->status)>active</option>
                            <option value="inactive" @selected($liveSession->status)>inactive</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('live-sessions.index') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    @include('includes.scripts')
@endsection
