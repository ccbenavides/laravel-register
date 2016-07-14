@if(Route::current()->getName() <> "backend.usuario.forzar_clave")

<div class="val_constrasenia">           
          <p class="label_form" for="categoria " ><span class="mif-lock"></span>  Contraseña Antigua:</p>
              <div class="input-control text full-size " data-role="input">
              {!! Form::password('password_anterior') !!}
                 <button class="button helper-button clear"><span class="mif-cross"></span></button>
              </div>
              
          </div>

@endif

<div class="val_constrasenia">           
          <p class="label_form" for="categoria " ><span class="mif-lock"></span>  Contraseña Nueva:</p>
              <div class="input-control text full-size " data-role="input">
              {!! Form::password('password_nueva') !!}
                 <button class="button helper-button clear"><span class="mif-cross"></span></button>
              </div>
              
          </div>
          <div class="val_constrasenia">           
          <p class="label_form" for="categoria " ><span class="mif-lock"></span>  Repetir Contraseña Nueva:</p>
              <div class="input-control text full-size " data-role="input">
              {!! Form::password('password_confirmar') !!}
                 <button class="button helper-button clear"><span class="mif-cross"></span></button>
              </div>
              
          </div>
		
		<div class="place-right pd_top30">
		    <input type="submit" id="validate_user" class="button primary">
		</div>