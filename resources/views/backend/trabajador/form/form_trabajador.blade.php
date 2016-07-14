<div class="mi_row">
	<div class="mi_cell_50 val_dni">
		<p class="label_form"><span class="mif-lock"></span> Dni </p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::text('dni',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50 val_nombre">
		<p class="label_form"><span class="mif-lock"></span> Nombres </p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::text('nombres',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50 val_apellido">
		<p class="label_form"><span class="mif-lock"></span> Apellidos </p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::text('apellidos',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50 val_sexo">
		<!-- VER SELECT -->
		<p class="label_form"> <span class="mif-lock"></span> Sexo </p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::select('sexo',
                			 array(
                			 '0' => 'masculino', 
                			 '1' => 'femenino'
                			 ),
                			 null,
                			['placeholder'=>'seleccione sexo']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50 val_fecha_nac">
		<p class="label_form">Fecha De Nacimiento</p>
        <div class="input-control text full-size" data-role="datepicker">
                {!! Form::text('fecha_nacimiento',null,['required']) !!}
              <button class="button"><span class="mif-calendar"></span></button>
        </div>
	</div><div class="mi_cell_50 val_direccion">
		<p class="label_form"><span class="mif-lock"></span> Dirección </p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::text('direccion',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50 val_referencia">
		<p class="label_form"><span class="mif-lock"></span> Referencia </p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::text('referencia',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50 val_tel_fijo">
		<p class="label_form"><span class="mif-lock"></span> Telefono Fijo: </p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::text('telefono_fijo',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50 val_tel_movil">
		<p class="label_form"> <span class="mif-lock"></span> Telefono Movil:</p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::text('telefono_movil',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50 val_correo_personal">
		<p class="label_form"><span class="mif-lock"></span> Correo Personal: </p>
		<div class="input-control text full-size" data-role="input">
                {!! Form::text('correo_personal',null) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
	</div><div class="mi_cell_50">
        <p class="label_form" for="categoria">Foto :</p>
        @if($aviso_imagen<>"normal" and strlen($aviso_imagen)>0)
             @include('backend.layouts.input_file_image',['id_visible'=>'id_visible'])
            <div class="align-center" id="ocultar_imagen">
                    <input type="hidden" id="input_hiden_imagen" name="bandera_eliminar_imagen" value="no_hacer_nada" id="">
                    <img class="file-upload-image" 
                         src="{{asset($ruta_imagen.$aviso_imagen) }} " alt="your image" />
                    <div class="image-title-wrap">
                      <button type="button" id="resetear_imagen" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                    </div>
            </div>
        @else
            @include('backend.layouts.input_file_image')

        @endif
    </div><div  class="mi_cell_50 ">
        <div class="val_correo_corporativo">
            <p class="label_form">Correo Corporativo: </p>
            <div class="input-control text full-size" data-role="input">
                    {!! Form::text('correo_corporativo',null) !!}
                        <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
        </div>
                <p class="label_form"> Estado : </p>
                <div>
                    <label class="input-control radio small-check pdr_20">
                                {!!  Form::radio('estado',true,true) !!}
                                <span class="check"></span>
                                <span class="caption">Activado</span>
                    </label>
                    <label class="input-control radio small-check">
                                {!!  Form::radio('estado',false) !!}
                                <span class="check"></span>
                                <span class="caption">Desactivado</span>
                    </label>
                </div>               
            </div>


</div>

<div class="place-right pd_top30 ">
    <span class="btn_verificando"></span>
    <input type="submit" class="button primary" id="validate_trabajador">
</div>