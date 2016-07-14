 <div class="row">
    <div class="mi_cell_50">           
            <p class="label_form" for="categoria " >Seleccione Categoria:</p>
                <div class="input-control text full-size" data-role="select">
                {!! Form::select('categoria_id',$lista_categoria,null,
                ['id'=>'select_categoria',
                'placeholder'=>'seleccione categoria']) !!}
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
                
    </div><div class="mi_cell_50">
        <p class="label_form" for="categoria " >Titulo:</p>
        <div class="input-control text full-size" data-role="input">
        {!! Form::text('titulo',null,['required']) !!}
            <button class="button helper-button clear"><span class="mif-cross"></span></button>
        </div>
    
    </div>
</div>


<div>
    <p for="descripcion" class="label_form">Descripción:</p>
    <div class="input-control textarea full-size min_height" data-role="input">
        {!! Form::textarea('descripcion',null,['rows'=>'5'])!!}
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
            <input type="submit" class="button primary">
</div>

