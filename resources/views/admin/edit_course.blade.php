<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Edit Course</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/material-bootstrap-wizard.css') }}" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="image-container set-full-height"
        style="background-image: url('{{ asset('assets/img/banner_1.jpg') }}')">
        <!--   Creative Tim Branding   -->
        <a href="https://tradingsociety.net">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('assets/img/new_logo.png') }}">
                </div>
                <div class="brand">
                    Trading Society
                </div>
            </div>
        </a>

        <!--  Made With Material Kit  -->
        <a href="http://demos.creative-tim.com/material-kit/index.html?ref=material-bootstrap-wizard"
            class="made-with-mk">
            <div class="brand">ES</div>
            <div class="made-with">Made with <strong>EPIK SoftWare by Ammar</strong></div>
        </a>
        <!--   Big container   -->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="purple" id="wizard">
                            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!--        You can switch " data-color="rose" "  with one of the next bright colors: "blue", "green", "orange", "purple"        -->

                                <div class="wizard-header">
                                    <h3 class="wizard-title">
                                        Edit Course
                                    </h3>
                                    <h5>This information will appears In Course Data.</h5>
                                </div>
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#location" data-toggle="tab">Basic data</a></li>
                                        <li><a href="#facilities" data-toggle="tab">Course Image</a></li>
                                        <li><a href="#description" data-toggle="tab">Description</a></li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="location">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="info-text"> edit basic details</h4>
                                            </div>
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" value="{{ $course->title }}" name="title"
                                                        class="form-control" id="exampleInputEmail1">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Total Duration</label>
                                                    <input type="text" name="total_hours"
                                                        value="{{ $course->total_hours }}" class="form-control"
                                                        id="exampleInputEmail1">
                                                </div>
                                            </div>
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Select Instructor</label>
                                                    <select class="form-control" name="instructor_id" id="">
                                                        @foreach ($instructors as $instructor)
                                                            <option value="{{ $instructor->id }}"
                                                                @selected($instructor->id == $course->instructor_id)>
                                                                {{ $instructor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 col-sm-offset">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Select Category</label>
                                                    <select class="form-control" name="category_id" id="">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                @selected($category->id == $course->category_id)>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="facilities">
                                        <h4 class="info-text">Upload a clear picture ,
                                            It will be a Course banner Image. </h4>
                                        <div class="row">
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Course Image</label>
                                                    <input name="photo" type="file" class="file">
                                                    <strong class="form-text text-muted">Click Here to Upload a clear
                                                        photo of the
                                                        course.</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="description">
                                        <div class="row">
                                            <h4 class="info-text"> Drop us a small description. </h4>
                                            <div class="col-sm-6 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Place description</label>
                                                    <textarea class="form-control" name="description" placeholder="" rows="9"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Example</label>
                                                    <p class="description">"Explore the fundamentals of trading
                                                        financial markets. Learn strategies, risk management, and
                                                        technical analysis to become a successful trader.
                                                        "</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Please fix the following errors:</strong>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-primary btn-wd'
                                            name='next' value='Next' />
                                        <input role="button" type="submit"
                                            class='btn btn-finish btn-fill btn-success btn-wd' name='finish'
                                            value='Finish' />
                                    </div>
                                    <div class="pull-left">
                                        <a class='btn btn-danger btn-wd'
                                            href="{{ route('admin.courses') }}">Cancle</a>
                                    </div>

                                    <div class="pull-right">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd'
                                            name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- wizard container -->
                </div>
            </div> <!-- row -->
        </div> <!--  big container -->

        <div class="footer">
            <div class="container text-center">
                Made with <i class="fa fa-heart heart"></i> by <a href=>EPIK SoftWare</a>.

            </div>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
<script src="{{ asset('assets/form-js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/form-js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/form-js/jquery.bootstrap.js') }}" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="{{ asset('assets/form-js/material-bootstrap-wizard.js') }}"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="{{ asset('assets/form-js/jquery.validate.min.js') }}"></script>

</html>
