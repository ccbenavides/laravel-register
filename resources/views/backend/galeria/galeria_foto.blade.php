@extends('backend.layouts.main')
@section('title',$title)

@section('content')
<div class="cell colspan10 padding30 bg-white top80" id="cell-content">


<!-- Mensaje de error -->
<div class="flash-message" id="error_imagen_space">
      <p class="alert alert-warning" >
    <span class="mif-bell mif-ani-ring mif-ani-slow"></span> &nbsp;
      Imagen no permitida - <span id="error_imagen_message"></span>  
    <span class="mif-cross move_x"></span>
      </p>
</div><!-- fin de mesaje de error --> 


    <h1 class="text-light">{{ $sub." de ".$galeria->titulo }}</h1>
    <hr class="thin bg-grayLighter mr_bot20">

    <form action="{{ url('backend/foto') }}"
          class="dropzone "
          id="addImages"
          method="POST">
        {{ csrf_field() }}
        <input type="hidden"
               name="gallery_id"
               value='{{ $galeria->id }}'>
    </form>


<!-- imagenes  recientes -->
<div class="padd_30 evento_eliminar" id="imagenes_recientes_space">
      <h3 class="text-light">Imagenes Recientes</h3>
      <hr class="thin bg-grayLighter">
      <div class="pd_top10" id="imagenes_recientes_append">
       
      </div>
</div> 
<!--  fin imagenes  recientes -->

<!-- imagenes no recientes -->
@if(count($galeria->imagenes)>0)
  <div class="padd_30 evento_eliminar" >
      <h3 class="text-light">Imagenes Subidas</h3>
      <hr class="thin bg-grayLighter">
      <div class="pd_top10">
      @foreach($galeria->imagenes as $imagen)
        <div class="mi_cell_20 imagen_{{$imagen->id}}" 
             id="bloque_imagen" 
             data-delete="{{route('backend.galeria.eliminarFoto',$imagen->id)}}"
             >
            <article class="article_imagen">
                <img src="{{asset('imagenes/galeria_imagen/album/'.$imagen->imagen)}}">
                <div class="middle_trash">
                  <span class="mif-cross"></span>
                  <p>Eliminar</p>
                  
                </div>

            </article>   
        </div>@endforeach
        
      </div>
  </div>  
@endif<!-- fin  imagenes no recientes -->


</div>


@endsection

@section('css-project')
	<link href="{{ asset('plugin/css/dropzone.css') }}" rel="stylesheet" />
@endsection
@section('javascript-project')
<script src="{{ asset('plugin/js/dropzone.js') }}"></script>
<script src="{{ asset('js/drop.js') }}"></script>	
	
	
@endsection
