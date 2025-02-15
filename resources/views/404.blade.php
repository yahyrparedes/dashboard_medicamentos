<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LANSIER Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url("assets/images/favicon.png") }}"/>

    <!-- Main style file -->
    <link rel="stylesheet" href="{{ url("dist/css/app.min.css") }}" type="text/css">
</head>
<body class="d-md-flex align-items-center justify-content-center">

<div class="container text-center p-5 p-md-0">
    <div class="row mb-4">
        <div class="col-md-4 m-auto">
            <figure>
                <img class="img-fluid" src="{{ url('assets/svg/404.svg') }}" alt="image">
            </figure>
        </div>
    </div>
    <h2 class="display-6">Page not found</h2>
    <p class="text-muted my-4">The page you want to go is not currently available</p>
    <div class="d-flex gap-3 justify-content-center">
        <a href="#" class="btn btn-primary">Home Page</a>
        <a href="#" class="btn bg-white">Back</a>
    </div>
</div>

<!-- Bundle scripts -->
<script src="{{ url("libs/bundle.js") }}"></script>

<!-- Main Javascript file -->
<script src="{{ url("dist/js/app.min.js") }}"></script>
</body>
</html>
