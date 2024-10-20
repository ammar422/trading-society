@extends('layouts.master')
@section('title', 'Trading Society')
@section('content')



    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Course</h4>
                <p class="card-description"> Please enter course information </p>
                <form class="forms-sample" action="{{ route('course.store') }}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Tilte</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            id="exampleInputName1" placeholder="Course Tilte" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Total Mins</label>
                        <input type="text" name="total_hours"
                            class="form-control @error('total_hours') is-invalid @enderror" id="exampleInputEmail3"
                            placeholder="Course total Duration" value="{{ old('total_hours') }}">
                        @error('total_hours')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" cols="30"
                            rows="10" placeholder="Course Description" >{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleSelectGender">Instructor Name</label>
                        <select class="form-control @error('instructor_id') is-invalid @enderror" id="exampleSelectGender"
                            name="instructor_id" value="{{ old('instructor_id') }}">
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                        @error('instructor_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="exampleSelectGender">Category Name</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="exampleSelectGender"
                            name="category_id" value="{{ old('category_id') }}">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Course Image</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                                value="{{ old('photo') }}">
                            @error('photo')
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
