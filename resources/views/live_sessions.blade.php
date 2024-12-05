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


    <div class="row">
        <div class="col-sm-12 grid-margin">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0"><a href="{{ route('live-sessions.create') }}">Add New Live Sessions</a>
                                </h2>
                            </div>
                            <h6 class="text-muted font-weight-normal">Number Of live Sessions So Far Is
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
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
                    <h4 class="card-title">live Sessions List</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> live Sessions No </th>
                                    <th> live Sessions title </th>
                                    <th> live Sessions duration </th>
                                    <th> live Sessions image</th>
                                    <th> live Sessions status</th>
                                    <th> Operations</th>
                                </tr>
                            </thead>
                            @if ($liveSessions)
                                <tbody>
                                    @foreach ($liveSessions as $liveSession)
                                        <tr>
                                            <td>{{ $liveSession->id }} </td>
                                            <td>{{ $liveSession->title }} </td>
                                            <td>{{ $liveSession->duration }} </td>
                                            <td>
                                                <img src="{{ $liveSession->image }}" alt="image" />
                                            </td>
                                            <td>{{ $liveSession->status }} </td>

                                            <td>
                                                <div class="badge">
                                                    <form action="" method="POST">
                                                        @method('delete') @csrf
                                                        <button class="badge badge-outline-danger" type="submit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="badge badge-outline-warning" role="button">
                                                    <a href="{{ route('live-sessions.edit', $liveSession->id) }}">
                                                        Edit
                                                    </a>
                                                </div>

                                                <div class="badge badge-outline-info" role="button"><a href="">
                                                        View live Sessions video
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            Showing
            <strong>{{ $liveSessions->firstItem() }}</strong> to
            <strong>{{ $liveSessions->lastItem() }}</strong> of
            <strong>{{ $liveSessions->total() }}</strong> results
        </div>
        <div>
            {{ $liveSessions->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>


@endsection
