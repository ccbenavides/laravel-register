@extends('backend.layouts.main')
@section('title',$title)

@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
                        <h1 class="text-light">
                            <a href="{{ URL::previous() }}"><span class="mif-arrow-left"></span> </a>
                            {{ $sub }}</h1>
                        <hr class="thin bg-grayLighter">
<br>
<div class="login-form">
        {!! Form::model($trabajador,[
        		'route'=>['backend.trabajador.update',$trabajador->id],
        		'method'=>'PUT',
        		'files'=> true 
        		])!!}
   
           @include('backend.trabajador.form.form_trabajador')

        {!! Form::close() !!}
        
</div>


</div>
@endsection

@section('javascript-project')

	<script type="text/javascript" src="{{ asset('js/validate/user.js') }}"></script>

@endsection