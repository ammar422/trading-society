<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Add New Instructor</title>

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
        style="background-image: url('{{ asset('assets/img/home-decor-3.jpg') }}')">
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
                        <div class="card wizard-card" data-color="orange" id="wizard">
                            <form action="{{ route('admin.instructor.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!--        You can switch " data-color="rose" "  with one of the next bright colors: "blue", "green", "orange", "purple"        -->

                                <div class="wizard-header">
                                    <h3 class="wizard-title">
                                        Add New Instructor
                                    </h3>
                                    <h5>This information will let new Instructor Able To Login.</h5>
                                </div>
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#location" data-toggle="tab">Login data</a></li>
                                        <li><a href="#type" data-toggle="tab">Position</a></li>
                                        <li><a href="#facilities" data-toggle="tab">Profile Image</a></li>
                                        <li><a href="#description" data-toggle="tab">Description</a></li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="location">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="info-text"> Let's start with the basic details</h4>
                                            </div>
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        id="exampleInputEmail1">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" name="email" class="form-control"
                                                        id="exampleInputEmail1">
                                                </div>
                                            </div>
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        id="exampleInputEmail1">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Confirm Password</label>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control" id="exampleInputEmail1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="type">
                                        <h4 class="info-text">What position will the new Instructor take? </h4>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <div class="choice" data-toggle="wizard-radio" rel="tooltip"
                                                        title="Select this option if you Want to .....">
                                                        <input type="radio" name="position" value="cto">
                                                        <div class="icon">
                                                            <i class="material-icons">person</i>
                                                        </div>
                                                        <h6>CTO</h6>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-radio" rel="tooltip"
                                                        title="Select this option if you Want to .....">
                                                        <input type="radio" name="position" value="other">
                                                        <div class="icon">
                                                            <i class="material-icons">menu_book</i>
                                                        </div>
                                                        <h6>Other</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="facilities">
                                        <h4 class="info-text">Upload a clear picture ,
                                            It will be a personal photo. </h4>
                                        <div class="row">
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Instructor Profile Photo</label>
                                                    <input id="photo" name="photo" type="file"
                                                        class="file">
                                                    <strong class="form-text text-muted">Click Here to Upload a clear
                                                        photo of the
                                                        instructor.</strong>
                                                </div>
                                            </div>

                                            <div hidden @disabled(true) class="col-sm-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Is air conditioning included ?</label>
                                                    <select class="form-control">
                                                        <option disabled="" selected=""></option>
                                                        <option>Yes</option>
                                                        <option>No </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div hidden @disabled(true) class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Does your place have wi-fi?</label>
                                                    <select class="form-control">
                                                        <option disabled="" selected=""></option>
                                                        <option>Yes</option>
                                                        <option>No </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div hidden @disabled(true) class="col-sm-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Is breakfast included?</label>
                                                    <select class="form-control">
                                                        <option disabled="" selected=""></option>
                                                        <option>Yes</option>
                                                        <option>No </option>
                                                    </select>
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
                                                    <textarea class="form-control" placeholder="" rows="9"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Example</label>
                                                    <p class="description">"A Forex and trading instructor teaches
                                                        strategies and market analysis for trading currencies,
                                                        empowering students to achieve financial success in trading.
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
                                            href="{{ route('admin.instructor') }}">Cancle</a>
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
