@if (count($errors))
	<div class="capa_error">		
		<div clas="div_error">
		@if(count($errors)<3)
			<span class="mif-warning error_icon color_error sx_error"></span>
		@elseif(count($errors)<5)
			<span class="mif-warning error_icon color_error md_error"></span>
		@else
			<span class="mif-warning error_icon color_error lg_error"></span>
		@endif
		<div class="div_error div_error_1 ">
		</div>
		    <ol class="error_ul">
		        @foreach($errors->all() as $error)
		            <li class="color_error">{{ $error }}</li>
		        @endforeach
		    </ol>
			
		</div>
		<span class="mif-cross move_x"></span>
	</div>
@endif