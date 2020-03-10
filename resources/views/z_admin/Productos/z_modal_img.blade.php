<!-- z_modal.blade.php -->
<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmProductos_img_modal">Large modal</button> -->

<div class="modal fade frmProductos_img_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
  
            <div class="modal-header text-white" style="background:  #004a93">
              <h5 class="modal-title" id="exampleModalLabel">Datos del Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
              </button>
            </div>
  
            <form id="frmProductos_img_modificar" class="needs-validation" enctype="multipart/form-data"> 


                <div class="modal-body">
    
                    {{-- <input type="hidden" name="" id="nome_token_productos_modal" required> --}}
                    <div class="container">
                        <input name="id_foraneo" type="hidden" id="id_foraneo">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input name="file_producto_img" type="file" class="custom-file-input" id="file_producto_img" aria-describedby="inputGroupFileAddon01">
                                <label id="file_producto_img_label" class="custom-file-label" for="file_producto_img">Subir una imagen</label>
                            </div>
                        </div>

                        <div class="row" id="tabla_infor_producto_img">
                            <iframe id="iframe_producto_img" src="/img/fondo3.jpg" width="100%" height="300px" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input id="btnGuardarImagenProducto" type="submit" class="btn btn-primary" value="Guardar"> <!-- data-dismiss="modal" -->
                </div>
            </form>

        </div>
    </div>
</div>
  