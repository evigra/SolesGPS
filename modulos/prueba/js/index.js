

$(document).ready(function($) {
var headers='Nombre, apellido, edad';
var datas={"Osvaldo, Leal, 22, Jorge, Martinez, 22"};
var LimitRow=8;
var maxHeight=800;
$(".qq").html(jQueryTable());


	

});



function jQueryTable(id_container, headers, datas, LimitRow, maxHeight) {

	var thead = '<tr id="cabecera">';

	
	$('#thead').empty()
	$('#thead').append(thead)

	var tbody = "";


	for (var i = 0; i < datas.length; i++) {
		tbody += '<tr>';

		console.log(indices);
		
		tbody += "<input type='hidden' name='id_cita_n' value="+datas[i][0]+">";
		for (var j = 1; j < indices; j++) {
		
			tbody += '<td>'+datas[i][j]+'</td>';
				
		}

		tbody += '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#nivel1" onclick="editar('+datas[i][0]+')">Nivel1</button></td>';
		tbody += '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#nivel2" onclick="editar2('+datas[i][0]+')">Nivel2</button></td>';
		tbody += '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#nivel3" onclick="editar3('+datas[i][0]+')">Nivel3</button></td>';
		tbody += '</tr>';
			
	

		if(i == LimitRow){
			$('#'+id_container).css({
            "overflow-y":"scroll",
            "max-height":maxHeight
        });}
	}

	$('.qq').empty()
	$('.qq').append(tbody)

}
