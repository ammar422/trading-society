@extends('layouts.master')
@section('title', 'Trading Society')
@section('content')



    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Adding videos to an existing course</h4>
                <p class="card-description"> Please enter course's videos information </p>
                <form class="forms-sample" action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleSelectGender">Select Course Name</label>
                        <select class="form-control" id="exampleSelectGender" name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Duration</label>
                        <input type="text" name="duration" class="form-control" id="exampleInputName1"
                            placeholder="Video Duration">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <input type="text" name="description" class="form-control" id="exampleInputEmail3"
                            placeholder="Video Description">
                    </div>

                    <div class="form-group">
                        <label>Video Image</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Video</label>
                        <input type="file" name="video_url" accept="video/*" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Video">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
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
