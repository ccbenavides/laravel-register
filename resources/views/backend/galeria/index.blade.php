@extends('backend.layouts.main')
@section('title',$title)

@section('content')
	<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
	@include('backend.layouts.message')
	@include('backend.layouts.cabezera_panel',['param'=>'galeria'])
	@include('backend.layouts.conteo_tabla',['param'=>'galeria'])


	<table class="table striped hovered border">
		<thead>
			<tr>
                <th class="pos_relative">
                    <a href="{{route('backend.galeria.index',
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
				<th>Nombre de Álbun</th>
				<th>Cantidad de Imagenes</th>
				<th>Estado</th>
				<th class="text-right">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $publicacion)
			<tr>
				<td>{{ $publicacion->created_at }}</td>
				<td>{{ $publicacion->titulo }}</td>

				<td>
					{{ $publicacion->cant_imagenes}}
				</td>
				<td>
					@if($publicacion->estado==false)
					
						Deshabilitado
					@else 
						Habilitado
					@endif</td>

				<td>
					<div class="dropdown-button  place-right">
					    <button class="button info dropdown-toggle">Accion</button>
					    <ul class="split-content d-menu place-right" data-role="dropdown">
					        <li><a href="{{ route('backend.galeria.agregarFotos',$publicacion->id ) }}">Agregar Fotos</a></li>
					        <li><a href="{{ route('backend.galeria.edit',$publicacion->id ) }}">Editar</a></li>
					        @if($publicacion->cant_imagenes == 0)
		        				<li><a href="#" 
					        		   class="llevar_form_eliminar"
					        		   datoId="{{ $publicacion->id }}"
					        		   datoNombre="{{ $publicacion->titulo }}"
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

	@include('backend.layouts.modal_destroy',['param'=>'galeria'])
@endsection