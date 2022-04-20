<!DOCTYPE html>
<html lang="en">

<head>
    @include('inc._metatags')
    <title> {{ config('app.name') }} </title>
    <link rel="icon" href="{{ asset('img/brand/favicon.png') }}" type="image/png"><!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/css/login.css') }} " id="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
    
    <div class="container">
        <div class="row">
			<div class="col-md-5 mx-auto">
			<div id="first">
				@yield('content')
			</div>
		</div>
      </div>  


    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
</body>
</html>
