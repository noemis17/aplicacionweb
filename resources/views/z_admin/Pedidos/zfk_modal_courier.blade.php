<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmCourier_modal">Large modal</button> -->

<div class="modal fade frmCourier_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

	  	<div class="modal-header text-white" style="background:  #004a93">
	        <h5 class="modal-title" id="exampleModalLabel">Asignar Transporte</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span class="text-white" aria-hidden="true">&times;</span>
	        </button>
	  	</div>

	  	<div class="modal-body">
			  
			<input type="hidden" name="" id="fk_courier_nome_token" value="fk_courier_nome_token">

			@include('z_admin.Pedidos.zfk_tabla_courier')

	  	</div>

	  	<div class="modal-footer">

	  	</div>

    </div>
  </div>
</div>
