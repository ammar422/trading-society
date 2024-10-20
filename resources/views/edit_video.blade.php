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
                <h4 class="card-title"> edit video of an existing course</h4>
                <p class="card-description"> Please modify course's videos information </p>
                <form class="forms-sample" action="{{ route('course_vedio.update', $courseVedio->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleSelectGender">Select Course Name</label>
                        <select class="form-control @error('course_id') is-invalid @enderror" id="exampleSelectGender"
                            name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" @selected($course->id == $courseVedio->course_id)>{{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Duration</label>
                        <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror"
                            id="exampleInputName1" placeholder="Video Duration" value="{{ $courseVedio->duration }}">
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <input type="text" name="description" value="{{ $courseVedio->description }}"
                            class="form-control @error('description') is-invalid @enderror" id="exampleInputEmail3"
                            placeholder="Video Description">
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Video Image</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="image" value="{{ old('image') }}"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror

                        </div>
                    </div>


                    <div class="form-group">
                        <label>Video</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="vedio_url"
                                class="form-control @error('vedio_url') is-invalid @enderror">
                            @error('vedio_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="bar">
                                <div class="percent">
                                    0%
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('courses.mainPage') }}" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    @include('includes.scripts')
     <script>
        $(document).ready(function() {
            var bar = $('.bar');
            var percent = $('.percent');
    
            $('form').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
    
                // Create a FormData object and append form data
                var formData = new FormData(this);
    
                $.ajax({
                    url: $(this).attr('action'), // Use the form's action URL
                    type: 'POST',
                    data: formData,
                    contentType: false, 
                    processData: false, 
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
    
                        // Upload progress  
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                var percentVal = percentComplete + '%';
                                bar.width(percentVal);
                                percent.html(percentVal);
    
                                // Update loading message with progress
                                Swal.update({
                                    title: 'Uploading...',
                                    html: `Progress: ${percentVal}`
                                });
                            }
                        }, false);
    
                        return xhr;
                    },
                    beforeSend: function() {
                        var percentVal = '0%';
                        bar.width(percentVal);
                        percent.html(percentVal);
    
                        // Show loading message
                        Swal.fire({
                            title: 'Uploading...',
                            html: 'Please wait while we upload your file.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.close();
    
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'File uploaded successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = "{{ route('course_vedio.edit', $courseVedio->id) }}";    
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
    
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';
                            for (var field in errors) {
                                errorMessages += errors[field].join('<br>') + '<br>';
                            }
    
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: errorMessages
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Failed',
                                text: 'There was an error uploading your file. Please try again.',
                            });
                        }
                    }
                });
            });
        });
    </script> 
    
@endsection
