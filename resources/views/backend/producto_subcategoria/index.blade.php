@extends('backend.layouts.main')
@section('title',$title)

@section('content')
	<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
	@include('backend.layouts.message')
	@include('backend.layouts.cabezera_panel',['param'=>'subcategoria_producto'])
	@include('backend.layouts.conteo_tabla',['param'=>'subcategoria_producto'])


	<table class="table striped hovered border">
		<thead>
			<tr>
                <th class="pos_relative">
                    <a href="{{route('backend.subcategoria_producto.index',
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
				<th>Categoría</th>
				<th>Imagen</th>
				<th>Estado</th>
				<th class="text-right">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $categoria_producto)
			<tr>
				<td>{{ $categoria_producto->created_at }}</td>
				<td>{{ $categoria_producto->nombre }}</td>
				<td>{{ $categoria_producto->nombre_categoria }}</td>
				<td>
						@if($categoria_producto->imagen)
							<img class="miniatura_imagen" 
								 src="{{ asset($ruta_mini.'/'.$categoria_producto->imagen)}}" alt=""> 
						@else
							sin imagen
						@endif
				</td>
				<td>
					@if($categoria_producto->estado==false)
					
						Deshabilitado
					@else 
						Habilitado
					@endif</td>

				<td>
					<div class="dropdown-button  place-right">
					    <button class="button info dropdown-toggle">Accion</button>
					    <ul class="split-content d-menu place-right" data-role="dropdown">
					        <li><a href="{{ route('backend.subcategoria_producto.edit',$categoria_producto->id ) }}">Editar</a></li>
					        @if($categoria_producto->cant_imagenes == 0)
		        				<li><a href="#" 
					        		   class="llevar_form_eliminar"
					        		   datoId="{{ $categoria_producto->id }}"
					        		   datoNombre="{{ $categoria_producto->nombre }}"
					        		   onclick="showDialog('#dialog')">Eliminar</a>
					        	</li>
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

	@include('backend.layouts.modal_destroy',['param'=>'subcategoria_producto'])
@endsection