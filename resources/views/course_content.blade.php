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

    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Videos List</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Video ID </th>
                                    <th> Video Order No </th>
                                    <th> Course title </th>
                                    <th> Video Duration </th>
                                    <th> Video Uploaded at </th>
                                    <th> Video Image </th>
                                    <th> Watch Video</th>
                                    <th> Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($courseVedios)
                                    @foreach ($courseVedios as $vedio)
                                        <tr>
                                            <td> {{ $vedio->id }}</td>
                                            <td> {{ $vedio->order }}</td>
                                            <td> {{ $vedio->course->title }}</td>
                                            <td> {{ $vedio->duration }}</td>
                                            <td> {{ $vedio->created_at }}</td>
                                            <td>
                                                <img src={{ $vedio->image }} alt="image" />
                                            </td>
                                            <td>
                                                <div class="badge badge-outline-success" role="button">
                                                    <a href="{{ route('course.vedio.watch', $vedio->id) }}">
                                                        Play
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="badge badge-outline-danger" role="button"> Delete</div>
                                                <div class="badge badge-outline-light" role="button"> Edit Order</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        @include('includes.scripts')
    @endsection
