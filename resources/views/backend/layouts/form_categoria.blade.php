         <div class="row">
            <div class="mi_cell_50">
                <div class="val_nombreCategoria">
                    <p class="label_form" for="categoria " > <span class="mif-lock"></span> Categoria:</p>
                    <div class="input-control text full-size" data-role="input">
                    {!! Form::text('nombre',null,['required']) !!}
                        <button class="button helper-button clear"><span class="mif-cross"></span></button>
                    </div>
                    
                </div>
               

                <p class="label_form" for="categoria">Imagen :</p>
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

            </div>
            
            <div class="mi_cell_50">
                <div>
                    <p for="descripcion" class="label_form">Descripción:</p>
                    <div class="input-control textarea full-size min_height" data-role="input">
                        {!! Form::textarea('descripcion',null,['class'=>'textarea_right'])!!}
                    </div>
                    
                </div>
                
            </div>
             
         </div>


            <div>
                <p class="label_form"> Estado :</p>
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

            <div class="place-right">
                <input type="submit" id="validate_categoria" class="button primary">
            </div>