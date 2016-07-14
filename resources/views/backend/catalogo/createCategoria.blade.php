@extends('backend.layouts.main')
@section('title',$title)


@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
						<h1 class="text-light">
							<a href="{{ URL::previous() }}"><span class="mif-arrow-left"></span> </a>
						{{ $sub }}</h1>
                        <hr class="thin bg-grayLighter">
<br>
@include('backend.layouts.errors')
<div class="login-form">
        {!! Form::open(['route'=>'backend.catalogo_categoria.store','method'=>'POST','files'=> true ])!!}
           	@include('backend.layouts.form_categoria') 
        {!! Form::close() !!}
        
</div>


</div>
@endsection


@section('javascript-project')

	<script type="text/javascript" src="{{ asset('js/validate/user.js') }}"></script>

@endsection