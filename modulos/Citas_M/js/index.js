$(document).ready(function()
{    






$("#auto_id_servicio").on("autocompleteselect", function( event, ui ) {

var valor=ui;
console.log(valor);
 var servi = valor["item"]["clave"];

$("#auto_id_detalle_servicio_proveedor").val(servi);
document.getElementById("auto_id_detalle_servicio_proveedor").innerHTML =servi; 
$('#auto_id_detalle_servicio_proveedor').keydown();


} );



    });
