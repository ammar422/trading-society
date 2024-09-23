@extends('layouts.master')
@section('title', 'Trading Society')
@section('content')



    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Course</h4>
                <p class="card-description"> Please enter course information </p>
                <form class="forms-sample" action="" method="Post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Tilte</label>
                        <input type="text" name="title" class="form-control" id="exampleInputName1"
                            placeholder="Course Tilte">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Total Hours</label>
                        <input type="text" name="total_hours" class="form-control" id="exampleInputEmail3"
                            placeholder="Course total Duration">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Description</label>
                        <input type="text" name="description" class="form-control" id="exampleInputPassword4"
                            placeholder="Course Description">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Instructor Name</label>
                        <select class="form-control" id="exampleSelectGender" name="instructor_id">
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Category Name</label>
                        <select class="form-control" id="exampleSelectGender" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Course Image</label>
                        <input type="file" name="photo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
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
