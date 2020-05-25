
<div class="modal fade" id="Modal_publicado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <div class="modal-body">
        <div class="row">
            
          <div class="col-lg-12">
            <div class="panel panel-default ">
                <div id="nombreCabecera" class="panel-heading text-center " style="color: black;">
                  INGRESO DUPLICADO
                 </div>
              <div class="panel-body">
              <form class="form-horizontal form "  id="frm_Pro">
                
                <div class="form-row">
                          
                      <div class="col-md-6">
                          <br> 
                     <br>
                          <label>Tipo de promoción </label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-building "></i></div>
                           <select name = "cmbTipoPromocion" id = "" class ="form-control pull-right" > </select> 
                          </div>
                          <br>
                          <label>Fecha de inicio</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                              <input  type="date" class="form-control pull-right " id="">
                          </div>
                          <br>
                          <label>Cantidad</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                              <input  type="number" class="form-control pull-right " id="">
                          </div>
                          
           
                      </div>  
                      <div class="col-md-6">
                      <br> 
                     <br>
                      <label>Descuento</label>
                          <div class="input-group"  >
                              <div class="input-group-addon"><i class="fa fa-building "></i></div>
                              <input  type="number" class="form-control  " id="ID_DECUENTO">
                          </div>
                        <br>
         
                          <label>Fecha final </label>
                          <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                              <input  type="date" class="form-control pull-right " id="">
                          </div>
                          <br>
                          <label>duplicado</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                              <input  type="text" class="form-control pull-right " id="">
                          </div>
                    
                      </div>
                      
              </form>      
            </div>
          </div>
        </div> 
          
        <div class="col-lg-12">
           <div class="panel panel-danger ">
              <div class="panel-heading text-center " style="color: black;">
                 DATOS DUPLICADO
                          </div>
                    <br>
                    <br>
                    
                    <div class="table-responsive">
                
                          <table class="display" id="">
                              <thead> <!-- style="border: 1px solid #000000" -->
                                <tr>
                      
                                </tr>
                              </thead>
                              <tbody id="">

                    

                              </tbody>
                            </table>
                      </div>

                    
                    </div>
              </div>
            </div> 
        </div>  

     


    </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="boton" value="guardar" type="button" class="btn btn-primary btn-sm" onclick="validarEjecucion()">AGREGAR</button>
       </div>
    </div>
  </div>
</div>



