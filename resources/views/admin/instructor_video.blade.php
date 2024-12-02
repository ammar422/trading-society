@extends('admin.layouts.master')

@section('page', 'instructor-video')

@section('content')
    {{ $instructor }}
    <div class="container">
        <h1>{{ $instructor->name }}'s Video</h1>

        @if (isset($instructor->video))
            <video width="640" height="360" controls>
                <source src="{{ $instructor->video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @elseif(isset($videoUrl))
            <video width="640" height="360" controls>
                <source src="{{ $instructor->video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
            <p>No video available for this instructor.</p>
        @endif
        <br>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Go Back</a>
    </div>
@endsection
