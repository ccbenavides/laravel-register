@extends('backend.layouts.main')
@section('title',$title)

@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
                        <h1 class="text-light">
						<a href="{{ URL::previous() }}"><span class="mif-arrow-left"></span> </a>
                        Nueva Categoría - {{ $sub }}</h1>
                        <hr class="thin bg-grayLighter">
<br>
<div class="login-form">
        {!! Form::open(['route'=>'backend.galeria_categoria.store','method'=>'POST','files'=> true ])!!}
   
           @include('backend.layouts.form_categoria')

        {!! Form::close() !!}
        
</div>


</div>
@endsection