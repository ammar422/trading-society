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
                                <h2 class="mb-0"><a href="">Add New Trade ALert (Offer)</a></h2>
                            </div>
                            <h6 class="text-muted font-weight-normal">Number Of Trade ALerts (Offers) So Far Is
                            </h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Trade Alert Chart</h4>
                    <canvas id="" class="transaction-chart"> <img src="{{ $offer->chart }}" alt="">
                    </canvas>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Instructor Name</h6>
                            <p class="text-muted mb-0">{{ $offer->instructor->name }}</p>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            {{-- <h6 class="font-weight-bold mb-0">{{ $offer->instructor->name }}</h6> --}}
                        </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Status</h6>
                            <p class="text-muted mb-0">{{ $offer->order_status }}</p>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            {{-- <h6 class="font-weight-bold mb-0">$593</h6> --}}
                        </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Price</h6>
                            <p class="text-muted mb-0">{{ $offer->price }}</p>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            {{-- <h6 class="font-weight-bold mb-0">$593</h6> --}}
                        </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Description</h6>
                            <p class="text-muted mb-0">{{ $offer->description }}</p>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            {{-- <h6 class="font-weight-bold mb-0">$593</h6> --}}
                        </div>
                    </div>

                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <a class="badge badge-outline-warning" href="{{ route("offer.mainpage") }}">
                                <strong>
                                    Back
                                </strong>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="card-title mb-1">Trade Alert Details</h4>
                        <p class="text-muted mb-1">Your data status</p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="preview-list">
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-primary">
                                            <i class="mdi mdi-file-document"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Pair</h6>
                                            <p class="text-muted mb-0">{{ $offer->pair }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                            <i class="mdi mdi-cloud-download"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Order Type </h6>
                                            <p class="text-muted mb-0">{{ $offer->order_type }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info">
                                            <i class="mdi mdi-clock"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">sl</h6>
                                            <p class="text-muted mb-0">{{ $offer->sl }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-danger">
                                            <i class="mdi mdi-email-open"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">TP1</h6>
                                            <p class="text-muted mb-0">{{ $offer->tp1 }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">TP2</h6>
                                            <p class="text-muted mb-0">{{ $offer->tp2 }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">TP3</h6>
                                            <p class="text-muted mb-0">{{ $offer->tp3 }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">TP4</h6>
                                            <p class="text-muted mb-0">{{ $offer->tp4 }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">TP5</h6>
                                            <p class="text-muted mb-0">{{ $offer->tp5 }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info">
                                            <i class="mdi mdi-clock"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Created At</h6>
                                            <p class="text-muted mb-0">{{ $offer->created_at }}</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">{{ $offer->created_at }}</p>
                                            <p class="text-muted mb-0">0 tasks, 0 issues</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="d-flex justify-content-between align-items-center">
        <div>
            Showing {{ $offers->firstItem() }} to {{ $offers->lastItem() }} of {{ $offers->total() }}
            results
        </div>
        <div>
            {{ $offers->links('vendor.pagination.bootstrap-4') }} <!-- Use Bootstrap pagination -->
        </div>
    </div> --}}




    @include('includes.scripts')
@endsection
