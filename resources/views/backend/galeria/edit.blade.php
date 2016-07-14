@extends('backend.layouts.main')
@section('title',$title)

@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
@include('backend.layouts.errors')
                        <h1 class="text-light">
						<a href="{{ URL::previous() }}"><span class="mif-arrow-left"></span> </a>
                        Editar  - {{ $sub }}</h1>
                        <hr class="thin bg-grayLighter">
<br>
<div class="login-form">
        {!! Form::model($galeria,[
        		'route'=>['backend.galeria.update',$galeria->id],
        		'method'=>'PUT',
        		'files'=> true 
        		])!!}
   
           @include('backend.galeria.form.form_album')

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