@extends('backend.layouts.main')

@section('title','login - sistema base')
@section('css-project')
	<style>
		.bg-darklogin{
			width: 100%;
			height: 100vh;
			background: #614385; /* fallback for old browsers */
			background: -webkit-linear-gradient(to left, #614385 , #516395); /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to left, #614385 , #516395); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
		}

        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -9.375rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }   
    </style>
@endsection

@section('javascript-project')
	<script type="text/javascript">
    	$(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
@endsection

@section('no-auth')
<div class="bg-darklogin">
    <div class="login-form padding20 block-shadow">
        <form action="{{ route('auth.login') }}" method="POST">
             {!! csrf_field() !!}
            <h1 class="text-light">Sistema Base</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="usuario">Usuario:</label>
                <input type="text" name="username" id="usuario">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Contraseña:</label>
                <input type="password" name="password" id="user_password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Ingresar</button>
                <button type="button" class="button link">Olvido su contraseña</button>
            </div>
        </form>
    </div>
</div>
@endsection