$(document).ready(function(){
	leer();
	

	
	
});

//
$(document).on('change', '#selectLugar', function(){
	

	var id_ = $(this).val();

	if(id_ === 'default'){
		vaciarTabla();
	}else {
		var id = {'id' : id_};
		crearTabla(id);
	}

	


	
	
});



function leer(){
	$.get('reporte-lugar/leer.php', function(respuesta){
		respuesta = JSON.parse(respuesta);
		console.log(respuesta);

		var texto = '';
 
		for (var i = 0; i < respuesta.length; i++) {
			id = respuesta[i].id;
			nombre = respuesta[i].nombre;

			texto += `
				<option value = "${id}">${nombre}</option>
			`; 

		}


		$('#selectLugar').append(texto);

	});

}



	function crearTabla(id){
		
		$.post('reporte-lugar/datosTabla.php', function(respuesta){
			
			$('#tabla_ReporteLugar').empty();

			respuesta = JSON.parse(respuesta);
			
			var fecha_x = respuesta.cantidadFecha;
			var hora_y = respuesta.cantidadHora;
			var horas = respuesta.hora;
			var fechas = respuesta.fecha;
			var formatoHora = respuesta.formatoHora;
			var formatoFecha = respuesta.formatoFecha;
			//var titulo = respuesta.

			var tabla = `<tr>
						<th>Hora/Fecha</th>;
						`;

			for (var i = 0; i < fechas.length; i++) {
				tabla += `<th>${fechas[i]['fecha']}</th>`
			}

				tabla += `</tr>`;


			for(var i = 0; i < hora_y; i++){
				tabla += `<tr>
							<td>${horas[i]['hora']}</td>`;			

				for(var j = 0; j < fecha_x; j++){
					tabla +=  `<td id = "${formatoFecha[j]}${formatoHora[i]}"></td>`;
				}

				tabla += `</tr>`;
			}

			$('#tabla_ReporteLugar').append(tabla);

			//console.log(formatoHora);

			$.post('reporte-lugar/ocupacionLugar.php', id, function(respuesta){
				respuesta = JSON.parse(respuesta);
				console.log(respuesta);
				
				var HI = [];
				var HF = [];
				var fecha = [];
				var titulo = [];
				
				for(var i = 0; i<respuesta.length; i++){
					HI.push(formatoHora.indexOf(respuesta[i]["HI"]));
					HF.push(formatoHora.indexOf(respuesta[i]["HF"]));
					fecha.push(formatoFecha.indexOf(respuesta[i]["fecha"]));
					titulo.push(respuesta[i]['titulo']);

				}

				//console.log(titulo);
				var color;

				for(var i = 0; i <= fecha.length; i++){
					for(var j = HI[i]; j <= HF[i]; j++){
						id = `${formatoFecha[fecha[i]]}${formatoHora[j]}`;
						$(`#${id}`).text(`${titulo[i]}`);
						$(`#${id}`).css('font-size', '12px');
						$(`#${id}`).css('background-color', 'salmon');
					}									
				}					

			});
			
		});


	}


	function vaciarTabla(){
		$('#divReporteLugar').empty();
		texto = `<table id = tabla_ReporteLugar class="table text-center table-bordered">                    
                </table>`;
        $('#divReporteLugar').append(texto);
	}

	function calcularColor(){
		var numRandom = Math.round(Math.random()*7);
		//console.log(numRandom);
		color = new Array();
		color = ['khaki', 'ivory', 'yellow', 'cyan', 'lavender', 'beige', 'white', 'salmon', 'pink'];

		return color[numRandom];

	}





