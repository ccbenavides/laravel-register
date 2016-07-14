@extends('backend.layouts.main')
@section('title',$title)

@section('content')
	<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
	@include('backend.layouts.message')
	@include('backend.layouts.cabezera_panel',['param'=>'usuario'])
	@include('backend.layouts.conteo_tabla',['param'=>'usuario'])


	<table class="table striped hovered border">
		<thead>
			<tr>
                <th class="pos_relative">
                    <a href="{{route('backend.usuario.index',
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
				<th>Usuario</th>
				<th>Trabajador</th>
				<th>Ultima Conexión</th>

				<th>Permisos</th>
				<th class="text-right">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $usuario)
			<tr>
				<td>{{ $usuario->created_at }}</td>
				<td>{{ $usuario->username }}</td>

				<td>
					@if($usuario->id_trabajador)
						{{$usuario->nombres}}
					@else 
						no asignado
					@endif	
				</td>
				<td>
					{{ $usuario->ultima_conexion }} 
				</td>
				<td>
						@foreach($usuario->permisos as $permiso)
							{{$permiso->descripcion}} <br>
						@endforeach
				</td>

				<td>
					<div class="dropdown-button  place-right">
					    <button class="button info dropdown-toggle">Accion</button>
					    <ul class="split-content d-menu place-right" data-role="dropdown">
					        <li><a href="{{ route('backend.usuario.edit',$usuario->id ) }}">Editar</a></li>
					        <li><a href="{{ route('backend.usuario.forzar_clave',$usuario->id ) }}">Cambiar Clave</a></li>
					       	<li><a href="#" 
					        		   class="llevar_form_eliminar"
					        		   datoId="{{ $usuario->id }}"
					        		   datoNombre="{{ $usuario->username }}"
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

	@include('backend.layouts.modal_destroy',['param'=>'usuario'])
@endsection