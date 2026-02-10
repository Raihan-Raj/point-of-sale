<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link href='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js' rel='stylesheet'>

	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/sidenav.style.css') }}">
    <title>AdminHub</title>
</head>
<body>

    <div>
        @yield('content')
    </div>
    
    <script src="{{ asset('js/sidenav.js') }}"></script>
</body>
</html>