<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('bootstrap/bootstrap.css')}}">
    <title>@yield('title')</title>
</head>
<body>
    @include('layouts.header')

    <div class="container">
        @yield('content')
    </div>

<script src="{{asset("bootstrap/bootstrap.bundle.js")}}"></script>
</body>
</html>

