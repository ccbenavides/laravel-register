<!-- Barra para buscar y conteo -->
<div class="grid barra_buscar ">
	<div class="row cells2">
		<div class="cell colspan6 align-left">
			<p >
			 @if(strlen($nombre)>0)
			 	@if($count == 0 )
			 		No existe ningun registro  con el nombre : {{ $nombre }}, quieres 
			 		<a class="underline" href="{{ route('backend.' .$param. '.index') }}">
			 			 ver todos
			 			
			 		</a>	
			 		
			 	@else
			 		Se han econtrado <span class="pe_cate">{{ $count }} </span > registros, quieres  
			 		<a class="underline" href="{{ route('backend.' .$param. '.index') }}"> ver todos</a>	
			 	@endif
			 @else
			  Existen  <span class="pe_cate">{{ $count }}</span > Registros.
			 @endif
				
			</p>
		</div>
		<div class="cell colspan6 align-right margin-0">
				<form method="GET" action={{ route('backend.'.$param.'.index') }}>
					<div class="input-control text ancho-comun" data-role="input">

					    	<input type="hidden" name="order_date" value="{{ $order_date }}">
							<input type="hidden" name="activa" value="0">
					    	<input type="text" name="nombre" placeholder="Buscar categoria">


					    	<button type="submit" class="button"><span class="mif-search"></span></button>					
					</div>
				</form>
		</div>
	</div>
	
</div>
<!-- Fin Barra para buscar y conteo -->