@extends('backend.layouts.main')
@section('title',$title)

@section('content')
	<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
	@include('backend.layouts.message')
	@include('backend.layouts.cabezera_panel',['param'=>'trabajador'])
	@include('backend.layouts.conteo_tabla',['param'=>'trabajador'])


	<table class="table striped hovered border">
		<thead>
			<tr>
                <th class="pos_relative">
                    <a href="{{route('backend.trabajador.index',
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
				<th>Nombres</th>
				<th>Foto</th>
			
				<th>Estado</th>
				<th class="text-right">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $trabajador)
			<tr>
				<td>{{ $trabajador->created_at }}</td>
				<td>{{ $trabajador->nombres }}</td>


				<td>
						@if($trabajador->foto)
							<img class="miniatura_imagen" src="{{ asset('imagenes/trabajador/miniatura/'.$trabajador->foto) }}" alt=""> 
						@else
							sin imagen
						@endif
				</td>
				<td>
					@if($trabajador->estado==false)
					
						Deshabilitado
					@else 
						Habilitado
					@endif</td>

				<td>
					<div class="dropdown-button  place-right">
					    <button class="button info dropdown-toggle">Accion</button>
					    <ul class="split-content d-menu place-right" data-role="dropdown">
					        <li><a href="{{ route('backend.trabajador.edit',$trabajador->id ) }}">Editar</a></li>
					       	<li><a href="#" 
					        		   class="llevar_form_eliminar"
					        		   datoId="{{ $trabajador->id }}"
					        		   datoNombre="{{ $trabajador->nombres }}"
					        		   onclick="showDialog('#dialog')">Eliminar</a>
					        </li>
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

	@include('backend.layouts.modal_destroy',['param'=>'trabajador'])
@endsection