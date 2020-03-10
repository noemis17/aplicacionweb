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
        url: '/api/v0/productos_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
        	console.log(data.items);
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
            // console.log(data);
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
                  var html = `
                    
                  `;
                
                  return `${html}`;
                  // return `<button>hola</button>`;

                }
            }
        ],
  /////////////////////////////////////////////////////////////////////////////////////
    });
  }
