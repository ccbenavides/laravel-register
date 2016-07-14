            <div class="">           
                <p class="label_form" for="categoria " > Seleccione Trabajador:</p>
                <div class="input-control text full-size" data-role="select">
                @if(count($lista_trabajadores)>0)
                    {!! Form::select('trabajador_id',$lista_trabajadores,'0',[
                                    'id'=>'select_trabajador',
                                    'placeholder'=>'seleccione Trabajador'
                                    ]) !!}
                     <button class="button helper-button clear"><span class="mif-cross"></span></button>
                @else
                    <div class="aviso_center">
                        No hay Trabajadores Para el Usuario
                        
                    </div>
                @endif
                </div>
                
            </div>
        <div class="mi_row">
    @if(Route::current()->getName() <> "backend.usuario.edit")
            <div class="val_username">           
                <p class="label_form" for="categoria " > <span class="mif-lock"></span>  Nombre de Usuario:</p>
                <div class="input-control text full-size" data-role="input">

                {!! Form::text('username',null) !!}
                   <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div>
          <!--   <div class="mi_cell_50 val_constrasenia">           
          <p class="label_form" for="categoria " ><span class="mif-lock"></span>  Contraseña:</p>
              <div class="input-control text full-size " data-role="input">
              {!! Form::password('password') !!}
                 <button class="button helper-button clear"><span class="mif-cross"></span></button>
              </div>
              
          </div>
           -->
    @endif
        <div class="val_permisos">           
            <p class="label_form" for="categoria " ><span class="mif-lock"></span>  Permisos:</p>
            <div class="input-control full-size">
                {!! Form::select('permisos[]',$lista_permisos,$lista_permisos_id,array(
                        'multiple'=>'multiple',
                        'name'=>'permisos[]',
                        'id'=>'select_permisos'
                        )) !!}
                
            </div>
                
            </div><div>
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
       </div>    


<div class="place-right pd_top30">
    <input type="submit" id="validate_user" class="button primary">
</div>


