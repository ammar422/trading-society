@extends('admin.layouts.master')
@section('page', 'Deals')
@section('title', 'Add New Trading Offer')
@section('content')

    <form  method="POST" action="{{ route('admin.offers.store') }}"
        enctype="multipart/form-data">
        @csrf

        <div class="form-container">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add New Trading Offer</h5>
                </div>
                <div class="card-body">
                    <!-- Main Trade Information -->
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <label for="instructor_id" class="form-label">Instructor</label>
                                <select name="instructor_id" class="form-control" id="pair">
                                    @if ($instructors)
                                        @foreach ($instructors as $instructor)
                                             <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                         @endforeach
                                    @endif
                                    </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pair" class="form-label">Trading Pair</label>
                            <input type="text" class="form-control @error('pair') is-invalid @enderror" id="pair"
                                name="pair"  placeholder="e.g., EUR/USD" required>
                            @error('pair')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="order_type" class="form-label">Order Type</label>
                            <input type="text" class="form-control @error('order_type') is-invalid @enderror"
                                id="order_type" name="order_type" "
                                placeholder="e.g., EUR/USD" required>
                            @error('order_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" step="0.01" required>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="order_status" class="form-label">Order Status</label>
                                 <select class="form-control @error('order_status') is-invalid @enderror" name="order_status"
                                 value="{{ old('order_status') }}">
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

                    <!-- Stop Loss & Take Profit Section -->
                    <h6 class="section-title">Stop Loss & Take Profit Levels</h6>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <label for="sl" class="form-label">Stop Loss</label>
                            <input type="number" class="form-control @error('sl') is-invalid @enderror" id="sl"
                                name="sl"  step="0.01">
                            @error('sl')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @foreach (range(1, 5) as $i)
                            <div class="col-md-4 mb-3">
                                <label for="tp{{ $i }}" class="form-label">Take Profit
                                    {{ $i }}</label>
                                <input type="number" class="form-control @error('tp' . $i) is-invalid @enderror"
                                    id="tp{{ $i }}" name="tp{{ $i }}"
                                    step="0.01">
                                @error('tp' . $i)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    <!-- Chart Upload -->
                    <div class="mb-4">
                        <label for="chart" class="form-label">Chart Image</label>
                        <div class="upload-area" onclick="document.getElementById('chart').click()">
                            <i class="fas fa-cloud-upload-alt mb-2" style="font-size: 2rem; color: #9ca3af;"></i>
                            <p class="mb-1">Click to upload or drag and drop</p>
                            <p class="small text-muted">PNG, JPG, GIF up to 10MB</p>
                            <input type="file" class="d-none @error('chart') is-invalid @enderror" id="chart"
                                name="chart" accept="image/*">
                        </div>
                        @error('chart')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div id="selected-file" class="small text-muted mt-2"></div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" placeholder="Enter trade description"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Publish Offer</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-code.js"></script>
    <script>
        // File upload preview
        document.getElementById('chart').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                document.getElementById('selected-file').textContent = `Selected file: ${fileName}`;
            }
        });

        // Form submission handler
        document.getElementById('editOfferForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            // Here you would typically send the formData to your server
            // using fetch or axios
            console.log('Form submitted');

            // Example fetch request:
            /*
            fetch('/api/offers/update', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
            */
        });
    </script>

@endsection
