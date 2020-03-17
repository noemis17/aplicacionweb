
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
                var html = "<button type='button' value="+data.id+" style='color: black;' class='btn btn-info abrirmodal'><i class='fa fa-tags' aria-hidden='true'></i>  Promociones</button>";
              
                return `${html}`;
                // return `<button>hola</button>`;

              }
          }
      ],
/////////////////////////////////////////////////////////////////////////////////////
  });
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////DATOS DE PROMOCIONES Y PRODUCTO////////////////////////////////////////////////////////////////////////////////////////
 
 //ingreso de producto y promocion
 function ingresarPromocionProducto(){ 
  swal({
    title: 'Estas seguro de esto?',
    text: "Si aceptas, se creará una nueva promocion al producto!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
}).then((willDelete) =>{
  if (willDelete) {
    var FrmData = {
      idPromociones: $('#cmbPromocion').val(),
      idProducto: id,
      fecha_inicio:$('#idfechainicio').val(),
      fecha_fin: $('#idfechafinal').val(),
      precio: $('#idPrecio').val(),
    
    }
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });
    
    $.ajax({
        url: servidor+'/api/v0/ProductoPromociones_store/'+$('#nome_token_user').val()+'/'+FrmData, // Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          cargar_tablaProductosPromocion();
          swal("ACCION EXITOSA!", "Datos Guardados", "success");   
        },
        error: function () {
          mensaje = "OCURRIO UN ERROR: Archivo->GestionProducto.js";
          swal(mensaje);
  
      }
    });  
  } else {
    swal("Cancelado!");
  }
});
}


var id = '';
//modal de producto promocion
 $('body').on('click','.abrirmodal',function(){
  $('#id_Procu').val('');
  id='';
  id=$(this).val();// este es el id del prodcuto que le va a servir al ingresar la pomocion del producto
  var informacion = new Array();
  i=0;
  $(this).parents("tr").find("td").each(function()
  {
    informacion[i]=$(this).html();
    i++;    
  })
  Promocones_Producto();
  cargar_tablaProductosPromocion() ;
   $('#modalPromocion').modal('show');
   $('#id_Procu').val(informacion[0]);
 });
// cargar select todas las promociones
 function Promocones_Producto() {
  $("#cmbPromocion").empty();

  $.ajax({
    type: "GET",
    
    url: servidor +'/api/v0/promociones_filtro/' + $('#nome_token_user').val(),
    async: false,
    dataType: "json",
    success: function (data) {
      $.each(data.items, function (key, registro){
        $("#cmbPromocion").append('<option value=' + registro.id + '>' + registro.descripcion + '</option>'); 
      });
    },
    error: function (data) {
      alert('error');
    }
  });
}
 //mostrar de producto y promocion
 function cargar_tablaProductosPromocion() {

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
        url: servidor+'/api/v0/ProductoPromociones_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          crear_tablaProductos_Promocion(data);
        	//console.log(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionProducto.js , funcion->cargar_tablaProducto()";
           	swal(mensaje);
        }
	});
}
function crear_tablaProductos_Promocion(data) {
  var ancho = '16%';
  $('#tablaProductoPromocion').html('');
  $('#tablaProductoPromo').html('');

  $('#tablaProductoPromocion').DataTable({
      destroy: true,
      order: [],

      data: data[0].promociones_producto,
      'createdRow': function (row, data, dataIndex) {
        //console.log(data);
      },
      'columnDefs': [
          {
             'targets': 3,
             'data':'data',
             'createdCell':  function (td, cellData, rowData, row, col) {

             },
          }
       ],
      columns: [
          {
              title: 'Promocion',
              width:ancho,
              data: 'promociones.descripcion'
          },
          {
              title: 'Fecha Inicio',
              width:ancho,
              data: 'fecha_inicio'
          },
          {
            title: 'Fecha fin',
            width:ancho,
            data: 'fecha_fin'
          },
          {
            title: 'Precio',
            width:ancho,
            data: 'precio'
          },
          {
            title: 'ACCIONES',
            width:ancho,
            data: null,
            render: function (data, type, row) {
              var html = "<button type='button'  class='btn btn-sm btn-danger eliminarProductoPromocion' value="+data.nome_token+" '><i class='fa fa-trash' aria-hidden='true'></i></button>";
            
              return `${html}`;
             

            }
         }
      ],

  });
}
$('body').on('click','.eliminarProductoPromocion',function(){
  PromocionProducto_eliminar($(this).val());
 });
 ///FUNCION DE ELIMINAR UNA PROMOCION A UN PRODUCTO SI FUE MAL ENVIADA
 function PromocionProducto_eliminar(nome_token) {

  var FrmData=
  {
    nome_token:  nome_token,
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
        url: servidor+'/api/v0/ProductoPromociones_delete/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Eliminados", "success");
          console.log(data);
          cargar_tablaProductosPromocion();
        
        },
        error: function (data) {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->usuarios_elimi()"
            console.log(data);
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });

}

///FUNCION DE ELIMINAR UNA PROMOCION A UN PRODUCTO SI FUE MAL ENVIADA

