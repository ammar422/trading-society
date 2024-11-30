@extends('layouts.master')
@section('title', 'Trading Society')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss='alert' aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss='alert' aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary bg-gradient">
                <h3 class="mb-0">Edit Trade Alert (Offer)</h3>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('offer.update', $offer->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <!-- Trading Pair -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pair" class="form-label">Trading Pair</label>
                                    <input type="text" class="form-control @error('pair') is-invalid @enderror"
                                        id="pair" name="pair" value="{{ old('pair', $offer->pair) }}"
                                        placeholder="e.g., EUR/USD" required>
                                    @error('pair')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Order status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order_status" class="form-label">Order Status</label>
                                    <select class="form-control @error('order_status') is-invalid @enderror"
                                        id="order_status" name="order_status" required>
                                        <option value="bending ">Bending </option>
                                        <option value="active ">Active </option>
                                        <option value="deleted">Deleted</option>
                                        <option value="hit_sl">Hit sl</option>
                                        <option value="hit_tp1">Hit tp1</option>
                                        <option value="hit_tp2">Hit tp2</option>
                                        <option value="hit_tp3">Hit tp3</option>
                                        <option value="hit_tp4">Hit tp4</option>
                                        <option value="hit_tp5">Hit tp5</option>
                                    </select>
                                    @error('order_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Order Type -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order_type" class="form-label">Order Type</label>
                                    <select class="form-control @error('order_type') is-invalid @enderror" id="order_type"
                                        name="order_type" required>
                                        <option value="Buy now ">Buy now </option>
                                        <option value="Sell now ">Sell now </option>
                                        <option value="Buy limit">Buy limit</option>
                                        <option value="Sell limit">Sell limit</option>
                                        <option value="Buy stop">Buy stop</option>
                                        <option value="Sell stop">Sell stop</option>
                                    </select>
                                    @error('order_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-label">Entry Price</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror" id="price"
                                        name="price" value="{{ old('price', $offer->price) }}" placeholder="Enter price"
                                        required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Stop Loss -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sl" class="form-label">Stop Loss</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('sl') is-invalid @enderror" id="sl" name="sl"
                                        value="{{ old('sl', $offer->sl) }}" placeholder="Stop Loss price">
                                    @error('sl')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Take Profit Levels -->
                            <div class="col-12">
                                <h5 class="mb-3">Take Profit Levels</h5>
                            </div>

                            <!-- TP1 to TP5 -->
                            @foreach (range(1, 5) as $i)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tp{{ $i }}" class="form-label">Take Profit
                                            {{ $i }}</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('tp' . $i) is-invalid @enderror"
                                            id="tp{{ $i }}" name="tp{{ $i }}"
                                            value="{{ old('tp' . $i, $offer->{'tp' . $i}) }}"
                                            placeholder="TP{{ $i }} price">
                                        @error('tp' . $i)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                            <!-- Chart Upload -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="chart" class="form-label">Chart Image</label>
                                    @if ($offer->chart)
                                        <div class="mb-2">
                                            <img src="{{ asset($offer->chart) }}" alt="Current Chart"
                                                class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('chart') is-invalid @enderror"
                                        id="chart" name="chart" accept="image/*">
                                    @error('chart')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="4" placeholder="Enter trade description">{{ old('description', $offer->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Trade Alert</button>
                                <a href="{{ route('courses.mainPage') }}" class="btn btn-dark">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    @include('includes.scripts')
@endsection
