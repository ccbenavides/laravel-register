  
        
       
       <div class="mi_row">
           
         <div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Seleccione Categoria:</p>
                <div class="input-control text full-size" data-role="select">
                {!! Form::select('catblog_id',$lista_categoria,null,['id'=>'select_categoria','placeholder'=>'seleccione categoria']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Titulo:</p>
                <div class="input-control text full-size" data-role="input">
                {!! Form::text('titulo',null,['required']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
            </div><div class="mi_cell_50">
                <p class="label_form" for="categoria">Imagen :</p>
                @include('backend.layouts.input_file_image')
                
            </div><div  class="mi_cell_50 ">
                <p class="label_form">Resumen :</p>
                <div class="input-control textarea full-size min_height " data-role="input">
                    {!! Form::textarea('resumen',null,['rows'=>'5','class'=>'textarea_right_2'])!!}
                </div>
                
            </div>
       </div>    




            <div>
                <p  class="label_form">Descripción :</p>
                <div class="input-control textarea full-size min_height" data-role="input">
                    {!! Form::textarea('descripcion',null,['rows'=>'5','id'=>"editor"])!!}
                </div>
                
            </div>

            <div class="">
                <p class="label_form" for="categoria">Archivo :</p>
                <div class="input-control file full-size" data-role="input">
                    {!! Form::file('archivo')!!}
                    <button class="button"><span class="mif-folder"></span></button>
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

            <input type="hidden" value="1" name="idioma_id">

<div class="place-right">
    <input type="submit" class="button primary">
</div>