<!doctype html>
<html lang="en">
<head>
	@section('header')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" ></link>
	<link rel="stylesheet" href="{{ URL::asset('css/simple-sidebar.css') }}" ></link>
	<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}"></link>
	@show
</head>
<body>

@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
@yield('javascript')
</body>
</html>
