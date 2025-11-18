<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Blade</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastify.css') }}">
    <script type="" src="{{ asset('js/toastify.js') }}"></script>
    <script type="" src="{{ asset('Js/config.js') }}"></script>
</head>
<body>

    <div>
        @yield('content')
    </div>
    
</body>
</html>