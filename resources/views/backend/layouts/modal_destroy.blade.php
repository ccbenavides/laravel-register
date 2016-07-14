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
	<form action="{{route('backend.'. $param .'.destroy',':delete')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="delete" />
		<input type="hidden" name="date_eliminar" class="in_data">
		<div class="padding10 align-center">
			<input class="button danger " type="submit" value="Eliminar">
			
		</div>
	</form>
</div>