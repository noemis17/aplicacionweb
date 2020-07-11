
var servidor="http://127.0.0.1:8000";


function cargar_tablaProductos(value='') {
	var FrmData=
	{
		value: value,
	}
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: servidor+'/api/v0/productos_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
        	//console.log(data.items);
           	crear_tablaProductos_v2(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionProducto.js , funcion->cargar_tablaProducto()";
           	swal(mensaje);
        }
	});
}

 function crear_tablaProductos(data) {
     $('#tablaProductos').html('');
        //console.log(data);
        $.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores

          var fila="";
         fila=`
            <tr class="fila_${item.id}">
               <th scope="row">${a+1}</th>
               <td><input type="hidden" value="${item.NAME}">${item.NAME}</td>
                <td><input type="hidden" value="${item.PRICE}">${item.PRICE}</td>
                <td><input type="hidden" value="${item.MARCA}">${item.MARCA}</td>
               <td><input type="hidden" value="${item.PESOITEM}">${item.PESOITEM}</td>
               <td><input type="hidden" value="${item.stock}">${item.stock}</td>
               
              
           </tr>
          `;
           //console.log(item);
            $('#tablaProductos').append(fila);

       });

}

// $('body').on('click','.addIagenes',function(){
//   console.log("dsd");
//   $('#Modal_publicado').modal('show');
 
//  });
function crear_tablaProductos_v2(data) {
  var ancho = '16%';
  $('#tablaProductos_padre').html('');
  $('#tablaProductos').html('');

  $('#tablaProductos_padre').DataTable({
      destroy: true,
      order: [],
      data: data.items,
      'createdRow': function (row, data, dataIndex) {
          //console.log(data);
      },
      'columnDefs': [
          {
             'targets': 3,
             'data':'item.id_item',
             'createdCell':  function (td, cellData, rowData, row, col) {

             },
          }
       ],
      columns: [
          {
              title: 'Nombre',
              width:ancho,
              data: 'NAME'
          },
          {
              title: 'Precio',
              width:ancho,
              data: 'PRICE'
          },
          {
            title: 'Marca',
            width:ancho,
            data: 'MARCA'
          },
          {
            title: 'Peso',
            width:ancho,
            data: 'PESOITEM'
          },
          {
            title: 'Stock',
            width:ancho,
            data: 'stock'
          },
          {
              title: 'ACCIONES',
              width:ancho,
              data: null,
              render: function (data, type, row) {
                var html = "<button type='button' value="+data.id+" style='color: black;' class='btn btn-info abrirmodal'><i class='fa fa-tags' aria-hidden='true'></i> Promociones</button>";
                // html+="<button type='button' value="+data.id+" style='color: black;' class='btn btn-info addIagenes'><i class='fa fa-tags' aria-hidden='true'></i>Imagen</button>";
                return `${html}`;
                // return `<button>hola</button>`;

              }
          }
      ],
/////////////////////////////////////////////////////////////////////////////////////
  });
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////DATOS DE DESCUENTO Y CANTIDAD ////////////////////////////////////////////////////////////////////////////////////////
var id = '';
var idcan = '';
$('body').on('click','.abrirmodal',function(){
  
  $('#IDcantidad').val('');
  idcan = '',
  idcan=$(this).val();
  $('#id_Procu_DE').val('');
   id='';
   id=$(this).val();// este es el id del prodcuto que le va a servir al ingresar la pomocion del producto
   var informacion = new Array();
    i=0;
    $(this).parents("tr").find("td").each(function()
    {
   informacion[i]=$(this).html();
    i++;    
   })
   cargartablaDescuento();
   $('#modaiddescuentoCantidad').modal('show');
   
   $('#id_Procu_DE').val(informacion[0]);
   $('#IDcantidad').val(informacion[4]);
   $('#IDcantidad1').attr({"min":informacion[4]});
   idcan = informacion[4];
 });
 ////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////ingrezar ////////////////////////////////////////////////////////////////////////////////////////
 
 function ingresarCantidaDescuento(){ 
    if(parseInt($('#IDcantidad1').val())>idcan ){
      swal({
        title: 'ERROR',
        text: "No puede colocar en promocion lo que no hay en stock",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if(parseInt($('#IDcantidad1').val())<=0){
      swal({
        title: 'ERROR',
        text: "No puede colocar en promocion lo que no hay en stock",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDcantidad1').val().trim() == ""){
      swal({
        title: 'ERROR',
        text: "Campo Cantidad Vacia",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDdescuento').val().trim() == ""){
      swal({
        title: 'ERROR',
        text: "Campo descuento Vacia",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if(parseInt($('#IDdescuento').val())<=0){
      swal({
        title: 'ERROR',
        text: "No se puede colocar un descuento menor o igual a cero",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDfechaFN').val()<=$('#IDfechaI').val()){
      swal({
        title: 'ERROR',
        text: "No puede colocar una fecha menor menor o igual que la de inicio",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDfechaI').val().trim() == ""){
      swal({
        title: 'ERROR',
        text: "Campo fecha inicio Vacia",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDfechaFN').val().trim() == ""){
      swal({
        title: 'ERROR',
        text: "Campo fecha final Vacia",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else
    {
      
    swal({
        title: 'Estas seguro de esto?',
        text: "Si aceptas, se creará una nueva promocion al producto!",
       
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) =>{
      if (willDelete) {
        var FrmData = {
          idProducto: id,
          descuento:$('#IDdescuento').val(),
          stock: $('#IDcantidad1').val(),
          fecha_inicio: $('#IDfechaI').val(),
          fecha_fin: $('#IDfechaFN').val(),
          
        }
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        
        $.ajax({
            url: servidor+''+'/api/v0/descuentoCantidad_store/'+FrmData, // Url que se envia para la solicitud esta en el web php es la ruta
            method: "POST",             // Tipo de solicitud que se enviará, llamado como método
            data: FrmData,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
            success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
            {
             
              cargartablaDescuento();
              cargar_tablaProductos('');
              limpiar();
              // console.log(data)
              if(data['code'] == "200"){
                swal("ACCION EXITOSA!", "Datos Guardados", "success");
              }else{
                swal("ERROR",data['message'], "success");
              
              }
            
            
            },
            
            error: function () {
              mensaje = "OCURRIO UN ERROR: Archivo->GestionProductodescuento.js";
              swal(mensaje);
      
          }
        });  
      } else {
        swal("Cancelado!");
     
      }
    });
   
  }
  
}
function limpiar() {
  $('input[type="number"]').val(null);
  $('input[type="date"]').val(null);
}
function cargartablaDescuento() {

	var FrmData=
	{
		idProducto: id,
	}
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

    $.ajax({
        url: servidor+'/api/v0/descuentoCantidad_filtro/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
        	
          crear_tablaDescuentoCantidad(data);
        	//console.log(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionProducto.js , funcion->cargar_tablaProducto()";
           	swal(mensaje);
        }
	});
}
function crear_tablaDescuentoCantidad(data) {

  var ancho = '16%';
  var anchos= '5%';
  $('#tablaDescuentoCantidad').html('');
  $('#tablaDescuentoCant').html('');

  $('#tablaDescuentoCantidad').DataTable({
     destroy: true,
    order: [],
    data: data.items,
      'createdRow': function (row, data, dataIndex) {
        //console.log(data);
      },
      'columnDefs': [
          {
             'targets':4,
             'data':'item.id_item',
             'createdCell':  function (td, cellData, rowData, row, col) {

             },
          }
       ],
      columns: [
         {
              width:anchos,
              data: null,
              render: function (data, type, row) {
                var html='';
                if(data.estado_del>0)
                {
                     var html = `<i class="fa fa-circle" ></i>`;
                }else
                {
                     html = ` `;
                }
                     return `${html}`;
                     
  
              }
              
          },
          {
              title: 'Descuento',
              width:ancho,
              data: 'descuento'
          },
          {
              title: 'Cantidad',
              width:ancho,
              data: 'stock'
          },
          {
            
            title: 'fecha Ingreso',
            width:ancho,
            data:null,
            render: function (data, type, row) {
              var html='';
              if(data.estado_del>0)
              {
                   var html = `${data.fecha_inicio}`;
              }else
              {
                   html = `${data.fecha_inicio} `;
              }
                   return `${html}`;
             

            }
            
          },
    
          {
              title: 'fecha-fin',
              width:ancho,
              data: null,
              render: function (data, type, row) {
                var html='';
                if(data.estado_del>0)
                {
                     var html = ``;
                }else
                {
                     html = ` ${data.fecha_fin}`;
                }
                     return `${html}`;
              
              }
          }
        //   {
        //     title: 'ACCIONES',
        //     width:ancho,
        //     data: null,
        //     render: function (data, type, row) {
        //       var html='';
        //       if(data.estado_del>0)
        //       {
        //            var html = `<button type="button" class="btn btn-sm btn-danger eliminardesc" value="${data.id}"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
        //       }else
        //       {
        //            html = `    
        //        `;
        //       }
        //            return `${html}`;
             

        //     }
        //  }
      ],

  });
}
$('body').on('click','.eliminardesc',function(){
  EliminarDescuento($(this).val());
  });
function EliminarDescuento(id) {
  
  var FrmData=
  {
    id: id,
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  swal({
    title: "Estas seguro de esto?",
    text: "Si aceptas, los datos seran eliminados!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) =>
   {
    if (willDelete) 
    {

      $.ajax({
        url: servidor+'/api/v0/descuentoCantidad_delete/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Eliminados", "success");
          //console.log(data);
          cargartablaDescuento();
        },
        error: function (data) {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->usuarios_elimi()"
        
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });

}


