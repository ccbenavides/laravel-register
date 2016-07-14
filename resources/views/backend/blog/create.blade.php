@extends('backend.layouts.main')
@section('title',$title)
@section('css-project')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugin/editor/ui/trumbowyg.min.css')}}">

@endsection



@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
@include('backend.layouts.errors')
						<h1 class="text-light">{{ $sub }}</h1>
                        <hr class="thin bg-grayLighter">
<br>
<div class="login-form">
        {!! Form::open(['route'=>'backend.blog.store','method'=>'POST','files'=> true ])!!}
             @include('backend.blog.form.publicacion_form')
        {!! Form::close() !!}
        
</div>


</div>
@endsection


@section('javascript-project')
	<script type="text/javascript" src="{{ asset('plugin/js/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugin/editor/trumbowyg.min.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			$("#select_categoria").select2();	
		});

		/*Editor*/
		$('#editor').trumbowyg();
	</script>
@endsection