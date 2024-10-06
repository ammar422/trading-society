@extends('layouts.master')
@section('title', 'Trading Society')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                {{ Session::get('success') }}
            </strong>
            <button type="button" class="close" data-dismiss='alert' aria-label="Close">
                <span aria-hidden="true">&times; </span>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>
                {{ Session::get('error') }}
            </strong>
            <button type="button" class="close" data-dismiss='alert' aria-label="Close">
                <span aria-hidden="true">&times; </span>
            </button>
        </div>
    @endif


    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Adding videos to an existing course</h4>
                <p class="card-description"> Please enter course's videos information </p>
                <form class="forms-sample" action="{{ route('courses.store_vedio') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleSelectGender">Select Course Name</label>
                        <select  class="form-control @error('course_id') is-invalid @enderror" id="exampleSelectGender"
                            name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Duration</label>
                        <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror"
                            id="exampleInputName1" placeholder="Video Duration" value="{{ old("duration") }}">
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <input type="text" name="description" value="{{ old("description") }}"
                            class="form-control @error('description') is-invalid @enderror" id="exampleInputEmail3"
                            placeholder="Video Description">
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Video Image</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="image" value="{{ old("image") }}" class="form-control @error('image') is-invalid @enderror"
                                value="{{ old('image') }}">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror

                        </div>
                    </div>


                    <div class="form-group">
                        <label>Video</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="vedio_url" value="{{ old("vedio_url") }}"
                                class="form-control @error('vedio_url') is-invalid @enderror"
                                value="{{ old('vedio_url') }}">
                            @error('vedio_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('courses.mainPage') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>


    @include('includes.scripts')
@endsection
