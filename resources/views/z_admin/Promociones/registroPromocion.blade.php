
<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>
<script src="{{ asset('js/select2.min.js') }}" defer></script> 
 <link href="{{ asset('css/select2.css') }}" rel="stylesheet"> 

<div class="panel panel-default " id="cardIngreso" >
		
               <div class="panel-heading text-center" >  <h3 class="panel-title"> <strong>INGRESOS DE DATOS PROMOCIONES</strong></h3> </div>
    <div class="panel-body ">
	

							<div class="col-sm-12 " >
										
								<button type="button" id="idmoda_REGISTRO" style="float:right" class="btn btn-success " data-toggle="modal" data-target="">ingreso tipo de promoción</button>
                               
                              
                            </div>
            
			<form class="form-horizontal form "  id="frm_Pro">
                           
                  <div class="form-row">
                            
                        <div class="col-md-6">
                            <br> 
			                 <br>
                            <label>Tipo de promoción </label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
								<select name = "cmbTipoPromocion" id = "cmbTipoPromocion" class ="form-control pull-right" > </select> 
                            </div>
                            <br>
                            <label>Descuento</label>
                            <div class="input-group"  >
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <input  type="number" class="form-control pull-right" id="ID_DESCUENTOS">
                            </div>
                            <br>
                            <label>Fecha de inicio</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                                <input  type="date" class="form-control pull-right " id="FECHA_INGRESO">
                            </div>
                        </div>  
                  
                        <div class="col-md-6">
                        <br> 
			                 <br>
                        <label>Nombre de la promoción</label>
                            <div class="input-group"  >
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <input  type="text" class="form-control pull-right " id="ID_Nombre">
                            </div>
                          <br>
                        <label>Cantidad</label>
                            <div class="input-group"  >
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <input  type="number" class="form-control pull-right " id="ID_CANTIDAD">
                            </div>
                          <br>
                            <label>Fecha final </label>
                            <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                                <input  type="date" class="form-control pull-right " id="FECHA_FINAL">
                            </div>
                      
                        </div>
                        
                  </div>
            </form>

					<br>
					<div class="col-md-12 ">
								<br>
								<br>
                          
                                <br>
                                <br>
                                <div class="table-responsive">
          
                                      <table class="display" id="tablaRegistroPro">
                                        <thead> <!-- style="border: 1px solid #000000" -->
                                          <tr>
                                  
                                          </tr>
                                        </thead>
                                        <tbody id="tablaREGISTRO">



                                          </tbody>
                                      </table>
                                </div>   
                             
                
                    </div>
				 
    </div>
    <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-sm" onclick="ingresarRegistroPromocion()">AGREGAR</button>
    </div> 

	@include('z_admin.TipoPromocion.registroTipo')
</div>

<!-- <script src="{{ asset('js/GestionPromocion.js') }}" defer></script> -->


