<div class="file-upload" id={{ $id_visible| "" }}>
                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                <div class="image-upload-wrap">
     
                      {!! Form::file('imagen',[
                                'class'=>'file-upload-input',
                                'onchange'=>"readURL(this);",
                                'accept'=>"image/*"
                                ])!!}      
                  <div class="drag-text">
                      <h3>Drag and drop a file or select add Image</h3>
                  </div>
                </div>
                <div class="file-upload-content">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <div class="image-title-wrap">
                      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                    </div>
                  </div>
</div><!-- fin plugin para subir imagen -->