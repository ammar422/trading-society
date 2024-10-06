@extends('layouts.master')
@section('title', 'Trading Society')
@section('content')
    <div class="col-12 grid-margin stretch-card">


        <video width="2000" height="560" controls autoplay muted loop poster="{{ $courseVedio->image }}">
            <source src="{{ asset('uploads/' . $courseVedio->vedio_url )}}" type="video/mp4">

        </video>


    </div>


    @include('includes.scripts')
@endsection
