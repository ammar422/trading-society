@extends('admin.layouts.master')
@section('page', 'instructors')
@section('content')




    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible text-white" role="alert">
            <span>
                {{ Session::get('success') }}
            </span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible text-white" role="alert">
            <span>
                {{ Session::get('error') }}
            </span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif


    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Instructors table</h6>
                    </div><br>
                    <style>
                        .left-align {
                            float: left;
                        }
                    </style>

                    <div class="col-6 left-align">
                        <a class="btn bg-gradient-dark mb-0" href="{{ route('admin.instructor.create') }}">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Instructor
                        </a>
                    </div>

                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="text-align: center">ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        @style('text-align:center')>
                                        Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        @style('text-align:center')>
                                        Position</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        @style('text-align:center')>
                                        Current status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        @style('text-align:center')>
                                        Operations</th>


                                </tr>
                            </thead>
                            <tbody>
                                @isset($instructors)
                                    @foreach ($instructors as $instructor)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0" style="text-align: center">
                                                    {{ $instructor->id }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $instructor->photo }}"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $instructor->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td @style('text-align:center')>
                                                <p class="text-xs text-secondary mb-0">{{ $instructor->email }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm" @style('text-align:center')>
                                                <span class="badge badge-sm bg-gradient-success">{{ $instructor->position }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center" @style('text-align:center')>
                                                <span
                                                    class="text-danger text-xs font-weight-bold">{{ $instructor->status }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.instructor.edit', $instructor->id) }}"
                                                        class="btn btn-warning btn-sm font-weight-bold text-xs"
                                                        style="margin-right: 0.5rem" data-toggle="tooltip"
                                                        data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    {{-- <a href="javascript:;"
                                                        class="btn btn-danger btn-sm font-weight-bold text-xs"  style="margin-right: 0.5rem"
                                                        data-toggle="tooltip" data-original-title="Delete user">
                                                        Delete
                                                    </a> --}}

                                                    <form action="{{ route('admin.instructor.destroy', $instructor->id) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm font-weight-bold text-xs"
                                                            style="margin-right: 0.5rem" data-toggle="tooltip"
                                                            data-original-title="@if ($instructor->status == 'inactive') Activate @else Deactivate @endif user">
                                                            Delete
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('admin.instructor.status', $instructor->id) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-info btn-sm font-weight-bold text-xs"
                                                            style="margin-right: 0.5rem" data-toggle="tooltip"
                                                            data-original-title="@if ($instructor->status == 'inactive') Activate @else Deactivate @endif user">
                                                            @if ($instructor->status == 'inactive')
                                                                Activate
                                                            @else
                                                                Deactivate
                                                            @endif
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
