@extends('layouts.master')
@section('title', 'Trading Society')
@section('content')


    <div class="row">
        <div class="col-sm-6 grid-margin">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0"><a href="{{ route('course.create') }}">Add New Course</a></h2>
                            </div>
                            <h6 class="text-muted font-weight-normal">Number Of Courses So Far Is
                                {{ App\models\Course::All()->count() }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 grid-margin">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0"><a href="{{ route('courses.add_video') }}"> Adding videos to an existing
                                        course </a></h2>
                            </div>
                            <h6 class="text-muted font-weight-normal">Number Of Videos So Far Is
                                {{ App\models\CourseVedio::All()->count() }}</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Courses List</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Course No </th>
                                    <th> Course title </th>
                                    <th> Course Hours </th>
                                    <th> Instructor Name</th>
                                    <th> Category Name</th>
                                    <th> Start Date </th>
                                    <th> Course Image </th>
                                    <th> Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>

                                        <td> {{ $course->id }}</td>
                                        <td> {{ $course->title }}</td>
                                        <td> {{ $course->total_hours }}</td>
                                        <td> {{ $course->instructor->name }}</td>
                                        <td> {{ $course->category->name }}</td>
                                        <td> {{ $course->created_at }}</td>
                                        <td>
                                            <img src={{ $course->photo }} alt="image" />
                                        </td>
                                        <td>
                                            <div class="badge badge-outline-danger" role="button"> Delete</div>
                                            <div class="badge badge-outline-warning" role="button"> Update</div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @include('includes.scripts')
@endsection
