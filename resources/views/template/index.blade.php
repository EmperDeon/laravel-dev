<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{  asset('/style.css') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @yield('header')
</head>
<body>
@include('part.nav-bar')

<div class="container">
    <div class="col-md-12">
        <div class="panel">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{  asset('/script.js')  }}"></script>
@yield('script')

</body>
</html>
