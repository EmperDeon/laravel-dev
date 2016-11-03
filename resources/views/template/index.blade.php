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
<header>
    @include('part.nav-bar')
</header>

<div class="container">
    @yield('content')
</div>

<script src="{{  asset('/script.js')  }}"></script>
@yield('script')

</body>
</html>
