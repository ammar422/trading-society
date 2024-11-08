<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/admin-assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/admin-assets/img/favicon.png">
    <title>
       @yield('title' , 'Admin Dashboard') 
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="/admin-assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/admin-assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/admin-assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <style>
        .form-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 24px;
            margin: 20px auto;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            font-size: 0.875rem;
        }

        .form-control, .form-select {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 12px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 2px rgba(236, 72, 153, 0.2);
        }

        .btn-primary {
            background-color: #ec4899;
            border-color: #ec4899;
            padding: 8px 16px;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #db2777;
            border-color: #db2777;
        }

        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f3f4f6;
            padding: 16px 24px;
        }

        .card-title {
            color: #111827;
            font-weight: 600;
            font-size: 1.25rem;
            margin: 0;
        }

        .section-title {
            color: #4b5563;
            font-size: 1.125rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .upload-area {
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .upload-area:hover {
            border-color: #ec4899;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('admin.layouts.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('admin.layouts.nav')
       @yield('content')
    </main>
    @include('admin.layouts.right_sidebar')
    @include('admin.includes.scripts')

</body>

</html>
