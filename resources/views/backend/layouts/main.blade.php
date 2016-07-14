<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=.70, maximum-scale=1.0, user-scalable=no">
	<title> @yield('title','pagina no diseñada')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/css/metro.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/css/metro-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/css/metro-responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/css/metro-schemes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/css/image_file.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/metro-reset.css') }}">
	@yield('css-project')
    

    <script type="text/javascript" src="{{ asset('plugin/js/jquery-2.1.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/js/metro.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/js/image_file.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    

    
</head>
<body>
    <div class="page-content">
        
    @if(Auth::check())
    @include('backend.layouts.menu')
    <!-- CONTENIDO -->
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row flex-just-center maestro_gris" >

                @yield('content')
                
            </div>
            
        </div>
    @endif
    @yield('no-auth')
    </div>
	@yield('javascript-project')
</body>
</html>