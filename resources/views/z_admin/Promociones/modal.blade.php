
<script>
  $(function () {
    

    //Date range picker
    $('#reservation').daterangepicker()
    

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    
  })
</script>
<div class="modal fade bd-example-modal-lg" id="modalPromocion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-body">
        <div class="row">
            
          <div class="col-lg-12">
            <div class="panel panel-danger ">
                <div class="panel-heading text-center " style="color: black;">
                  INGRESO DE PROMOCIONES A PRODUCTOS 
                 </div>
              <div class="panel-body">
               <form class="form-horizontal" id="frmProduPromo">
                     <div class="form-group">     
                            <div class="col-md-6"> 
                            <label>Datos del Producto</label>
                              <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-building bigicon"></i></div>
                                  <input readonly type="text" class="form-control pull-right " id="id_Procu">
                              </div>
                            </div>
                            <div class="col-sm-6"> 
                            <label>Datos del Promoción</label>
                              <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-tags bigicon"></i></div>
                                  <select id="cmbPromocion" class="js-example-basic-single forma" name="state" >
                                   </select>
                              </div>
                            </div>
                            
                    </div> 
                    <div class="form-group">    
                            <div class="col-sm-6">
                             <label>Precio</label>
                               <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-money bigicon"></i></div>
                                  <input type="text" class="form-control pull-right " id="idPrecio">
                                </div>
                             </div>
                             <div class="col-sm-3">
                             <label>Fecha inicio</label>
                               <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-calendar bigicon"></i></div>
                                  <input type="date" class="form-control pull-right " id="idfechainicio">
                                </div>
                             </div>
                             <div class="col-sm-3">
                             <label>Fecha final</label>
                               <div class="input-group">
                                 
                                  <input type="date" class="form-control pull-right  " id="idfechafinal">
                                </div>
                             </div>
                    </div>
                    
                    
                    </form>         
              </div>
            </div>
          </div> 
          
        <div class="col-lg-12">
        <div class="panel panel-danger ">
        <div class="panel-heading text-center " style="color: black;">
                  PROMOCIONES DEL PRODUCTOS 
                 </div>
          <br>
          <br>
          
          <div class="table-responsive">
      
           <table class="display" id="tablaProductoPromocion">
              <thead> <!-- style="border: 1px solid #000000" -->
                <tr>
       
                </tr>
              </thead>
              <tbody id="tablaProductoPromo">

     

               </tbody>
            </table>
            </div>

          
          </div>
          </div>
        </div> 
       </div>  

     



     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="ingresarPromocionProducto()">AGREGAR</button>
       
     
     
      </div>
     








   
    </div>
  </div>
</div>


 <!-- <script src="{{ asset('js/GestionPromocion.js') }}" defer></script> -->








  










