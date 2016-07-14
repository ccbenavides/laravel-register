@extends('backend.layouts.main')
@section('title',$title)




@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
						<h1 class="text-light">{{ $sub }}</h1>
                        <hr class="thin bg-grayLighter">
<br>
@include('backend.layouts.errors')
<div class="login-form">
        {!! Form::open(['route'=>'backend.empresa.store','method'=>'POST','files'=> true ])!!}
             @include('backend.empresa.form.form_empresa')
        {!! Form::close() !!}
        
</div>


</div>
@endsection


