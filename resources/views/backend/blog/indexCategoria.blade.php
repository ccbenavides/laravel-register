@extends('backend.layouts.main')
@section('title','gestionar categoria')

@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
@include('backend.layouts.message')

                	<h1 class="text-light">{{ $sub }} - Listado</h1>
                	<hr class="thin bg-grayLighter">
                	<a href="{{route('backend.blog_categoria.create')}}" class="button primary">
                		<span class="mif-plus"></span> Create...</a>
                	<hr class="thin bg-grayLighter">
	
<!-- Barra para buscar y conteo -->

@include('backend.layouts.conteo_tabla',['param'=>'blog_categoria'])
<!-- Fin Barra para buscar y conteo -->


	<table class="table striped hovered border">
		<thead>
			<tr>
				<th class="pos_relative">
					<a href="{{route('backend.blog_categoria.index',
								['order_date'=>$order_date,
								'nombre'=>$nombre,
								'activa'=>'1' ])}}" class="button_radius">
						Fecha	
						@if($order_date == 'asc')
							<span class="mif-arrow-up"></span>
						@else
							<span class="mif-arrow-down"></span>
						@endif
						
					</a>
				</th>
				<th>Nombre</th>
				<th>Imagen</th>
				<th>Publicaciones</th>
				<th>Estado</th>
				<th class="text-right">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $cat_blog)
				<tr>
					<td>{{ $cat_blog->created_at }}</td>
					<td>{{ $cat_blog->nombre }}</td>
					<td>
						@if($cat_blog->imagen)
							<img class="miniatura_imagen" src="{{ asset('imagenes/blog_imagen/miniatura') }}/{{ $cat_blog->imagen }}" alt=""> 
						@else
							sin imagen
						@endif
					</td>

					<td>
						{{ $cat_blog->publicaciones }}
					</td>

					<td>@if($cat_blog->estado==false)
							Deshabilitado
						@else 
							Habilitado
						@endif
					</td>


					<td>
						<div class="dropdown-button  place-right">
						    <button class="button info dropdown-toggle">Accion</button>
						    <ul class="split-content d-menu place-right" data-role="dropdown">

						        <li><a href="{{ route('backend.blog_categoria.edit',$cat_blog->id ) }}">Editar</a></li>

						        @if($cat_blog->getCantidadPublicaciones() == 0)
						        	<li><a href="#" 
						        		   class="llevar_form_eliminar"
						        		   datoId="{{ $cat_blog->id }}"
						        		   datoNombre="{{ $cat_blog->nombre }}"
						        		   onclick="showDialog('#dialog')">Eliminar</a></li>
						        @endif
						    </ul>
						</div>
					</td>
				</tr>
					
			@endforeach

		</tbody>
	</table>
	{!! $data->setPath('')->appends(Input::query())->render() !!}
		<span class="num_page">estamos en la pagina numero :
			 <span class="pe_cate">{{ $data->currentPage() }}</span>
		</span>
	

</div>

<!-- MODAL -->
<div data-role="dialog" 
	 id="dialog"
	 class="padding20 dialog dialog_reset"
	 data-overlay ="true"
	 data-overlay-color="op-dark"
	 data-close-button="true"
	 data-overlay-click-close="true"
	 >
	<h1 class="fg-red"><span class="mif-warning margin5"></span>Alerta !</h1>
	<hr class="thin bg-grayLighter">
	<h5>Desea eliminar a : <strong class="nombre_modal"></strong></h5>
	<form action="{{route('backend.blog_categoria.destroy',':delete')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="delete" />
		<input type="hidden" name="date_eliminar" class="in_data">
		<div class="padding10 align-center">
			<input class="button danger " type="submit" value="Eliminar">
			
		</div>
	</form>
</div>

<!-- FIN MODAL -->
@endsection

