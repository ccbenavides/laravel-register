      
       <div class="mi_row">
           
            <div class="mi_cell_50">           
                <p class="label_form" for="categoria " >Razon Social:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('razon_social',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">
                <p class="label_form" for="categoria">Icono de la Empresa :</p>
                <div class="input-control file full-size" data-role="input">
                    {!! Form::file('ruta_logo')!!}
                    <button class="button"><span class="mif-folder"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Ruc:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('ruc',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Telefono fijo:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('telefono_fijo',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Telefono Movistar:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('telefono_movistar',null) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Telefono Claro:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('telefono_claro',null) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Otro Telefono:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('telefono_otro',null) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Email:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::email('email',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Usuario de Facebook:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('facebook_usuario',null) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >App Id Facebook:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('facebook_app_id',null) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div>
       </div>    






            <input type="hidden" value="1" name="idioma_id">

<div class="place-right pd_top30">
    <input type="submit" class="button primary">
</div>