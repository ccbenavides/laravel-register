@extends('backend.layouts.main')
@section('title',$title)

@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
                        <h1 class="text-light">
                        	<a href="{{ URL::previous() }}"><span class="mif-arrow-left"></span> </a>
                        	{{ $sub }} - {{ $subcategoria->username  }}</h1>
                        <hr class="thin bg-grayLighter">
<br>
<div class="login-form">

        {!! Form::model($subcategoria,[
        		'route'=>['backend.subcategoria_producto.update',$subcategoria->id],
        		'method'=>'PUT',
        		'files'=> true 
        		])!!}
   			
       
           @include('backend.producto_subcategoria.form_subcategoria')

        {!! Form::close() !!}
        
</div>


</div>
@endsection


@section('javascript-project')
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
@endsection