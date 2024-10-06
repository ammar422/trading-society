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
                                <h2 class="mb-0"><a href="">Add New Level</a></h2>
                            </div>
                            <h6 class="text-muted font-weight-normal">Number Of Levels So Far Is
                            </h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 grid-margin">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0"><a href=""> Edit Levels Order </a></h2>
                            </div>
                           
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>



    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Categories List</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Category No </th>
                                    <th> Category Name </th>
                                    <th> Category Order </th>
                                    <th> Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>

                                        <td> {{ $category->id }}</td>
                                        <td> {{ $category->name }}</td>
                                        <td> {{ $category->order }}</td>
                                        <td>
                                            <div class="badge">
                                                <form action="" method="POST">
                                                    @method('delete') @csrf
                                                    <button class="badge badge-outline-danger" type="submit">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="badge badge-outline-warning" role="button"> Edit</div>

                                            <div class="badge badge-outline-info" role="button"><a
                                                    href="">
                                                   edit order
                                                </a>
                                            </div>
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
    <div class="d-flex justify-content-between align-items-center">
        <div>
            Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }}
            results
        </div>
        <div>
            {{ $categories->links('vendor.pagination.bootstrap-4') }} <!-- Use Bootstrap pagination -->
        </div>
    </div>




    @include('includes.scripts')
@endsection
