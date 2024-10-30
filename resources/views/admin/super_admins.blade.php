@extends('admin.layouts.master')
@section('page', 'ٍSuper Admins')
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
                        <h6 class="text-white text-capitalize ps-3">Super Admins table</h6>
                    </div><br>
                    <style>
                        .left-align {
                            float: left;
                        }
                    </style>

                    <div class="col-6 left-align">
                        <a class="btn bg-gradient-dark mb-0" href="{{ route('admin.instructor.create') }}">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Super Admin
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
                                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        @style('text-align:center')>
                                        Position</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        @style('text-align:center')>
                                        Current status</th> --}}
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        @style('text-align:center')>
                                        Operations</th>


                                </tr>
                            </thead>
                            <tbody>
                                @isset($super_admins)
                                    @foreach ($super_admins as $super_admin)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0" style="text-align: center">
                                                    {{ $super_admin->id }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $super_admin->photo }}"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $super_admin->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td @style('text-align:center')>
                                                <p class="text-xs text-secondary mb-0">{{ $super_admin->email }}</p>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="" class="btn btn-warning btn-sm font-weight-bold text-xs"
                                                        style="margin-right: 0.5rem" data-toggle="tooltip"
                                                        data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    <form action="" method="POST" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm font-weight-bold text-xs"
                                                            style="margin-right: 0.5rem" data-toggle="tooltip">
                                                            Delete
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
