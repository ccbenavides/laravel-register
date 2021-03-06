@extends('backend.layouts.main')
@section('title',$title)

@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
@include('backend.layouts.message')
                        <h1 class="text-light">{{ $sub }} - {{ $usuario->username  }}</h1>
                        <hr class="thin bg-grayLighter">
<br>
<div class="login-form">

        {!! Form::model($usuario,[
        		'route'=>['backend.usuario.cambiando_clave',$usuario->id],
        		'method'=>'PUT',
        		])!!}
   			
         @include('backend.usuario.form.form_clave')

        {!! Form::close() !!}
        
</div>


</div>
@endsection


{{-- @section('javascript-project')
	<script type="text/javascript" src="{{ asset('plugin/js/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/validate/user.js') }}"></script>
	<script type="text/javascript">
		$(function(){
			$("#select_permisos").select2({
			  tags: true
			});
			$("#select_trabajador").select2();	
		});



	</script>
@endsection --}}