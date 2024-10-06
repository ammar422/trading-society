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

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Trade Alert</h4>
                <p class="card-description"> Please enter Trade Alert information </p>
                <form class="forms-sample" action="{{ route('offer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleSelectGender">Instructor Name</label>
                        <select class="form-control @error('instructor_id') is-invalid @enderror" id="exampleSelectGender"
                            name="instructor_id" value="{{ old('instructor_id') }}">
                            <option value="{{ Auth::id() }}">{{ Auth::user()->name }}</option>
                        </select>
                        @error('instructor_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Order Status</label>
                        <input type="text" name="order_status"
                            class="form-control @error('order_status') is-invalid @enderror" id="exampleInputName1"
                            placeholder="Order Status" value="{{ old('order_status') }}">
                        @error('order_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Pair</label>
                        <input type="text" name="pair" class="form-control @error('pair') is-invalid @enderror"
                            id="exampleInputEmail3" placeholder="Trade Alert Pair" value="{{ old('pair') }}">
                        @error('pair')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Price</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                            id="exampleInputPassword4" placeholder="Trade Alert price" value="{{ old('price') }}">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">Order Type</label>
                        <input type="text" name="order_type"
                            class="form-control @error('order_type') is-invalid @enderror" id="exampleInputPassword4"
                            placeholder="Trade Alert order_type" value="{{ old('order_type') }}">
                        @error('order_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">sl</label>
                        <input type="text" name="sl" class="form-control @error('sl') is-invalid @enderror"
                            id="exampleInputPassword4" placeholder="Trade Alert sl" value="{{ old('sl') }}">
                        @error('sl')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">tp1</label>
                        <input type="text" name="tp1" class="form-control @error('tp1') is-invalid @enderror"
                            id="exampleInputPassword4" placeholder="Trade Alert tp1" value="{{ old('tp1') }}">
                        @error('tp1')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">tp2</label>
                        <input type="text" name="tp2" class="form-control @error('tp2') is-invalid @enderror"
                            id="exampleInputPassword4" placeholder="Trade Alert tp2" value="{{ old('tp2') }}">
                        @error('tp2')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">tp3</label>
                        <input type="text" name="tp3" class="form-control @error('tp3') is-invalid @enderror"
                            id="exampleInputPassword4" placeholder="Trade Alert tp3" value="{{ old('tp3') }}">
                        @error('tp3')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">tp4</label>
                        <input type="text" name="tp4" class="form-control @error('tp4') is-invalid @enderror"
                            id="exampleInputPassword4" placeholder="Trade Alert tp4" value="{{ old('tp4') }}">
                        @error('tp4')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">tp5</label>
                        <input type="text" name="tp5" class="form-control @error('tp5') is-invalid @enderror"
                            id="exampleInputPassword4" placeholder="Trade Alert tp5" value="{{ old('tp5') }}">
                        @error('tp5')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id=""
                            cols="30" rows="10" placeholder="Trade Alert description" value="{{ old('description') }}">
                        </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Chart Image</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="chart"
                                class="form-control @error('chart') is-invalid @enderror" value="{{ old('chart') }}">
                            @error('chart')
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
