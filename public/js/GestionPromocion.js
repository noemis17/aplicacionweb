// var servidor = "http://127.0.0.1:8000";


// function Promocones_Producto() {
//   $.ajax({
//     type: "GET",
//     url: servidor + '/api/v0/promociones_filtro/' + $('#nome_token_user').val() + '/' + FrmData,
//     async: false,
//     dataType: "json",
//     success: function (data) {
//       $.each(data, function (key, registro) {
//         console.log("datos promociones",registro);
        
//         // var id = "";
//         // var descripcion = "";
//         // $.each(registro, function (key, value) {
//         //   //alert(campo + ": " + valor);
//         //   if (key == "id") { id = value; }
//         //   if (key == "descripcion") { descripcion = value; }

//         // });
//       });
//       $("#SelectPromocion").append('<option value=' + id + '>' + descripcion + '</option>');
//     },
//     error: function (data) {
//       alert('error');
//     }
//   });
// }