var i=1;
var j=1;
var k =1;
var l = 1;
var m = 1;


$(document).on('click', '#btn_agregarReq', function(){
	
	if(l == 5){
		l = l;
	}else {
		$('#tableReq').clone().appendTo("#divReq");			
		l++;
	}
});


$(document).on('click', '#btn_quitarReq', function(){
		
	if(l == 1){
		l = l;

	}else {

		$(this).parent('td').parent('tr').remove();
		l--;
	}
});


$(document).on('click', '#btn_agregarMaterial', function(){
	
	if(m == 5){
		m = m;
	}else {
		$('#tableMaterial').clone().appendTo("#divMaterial");			
		m++;
	}
});

$(document).on('click', '#btn_quitarMaterial', function(){
		
	if(m == 1){
		m = m;

	}else {

		$(this).parent('td').parent('tr').remove();
		m--;
	}
});


$(document).on('click', '#btn_agregarHorario', function(){
		//console.log(i);
		if(k == 10){
			k = k;
		}else {
			$('#tableHorario').clone().appendTo("#tableBodyHorario");			
			k++;
		}
});

$(document).on('click', '#btn_quitarHorario', function(){
		
		if(k == 1){
			k = k;

		}else {

			$(this).parent('td').parent('tr').remove();
			k--;
		}
	});

$('#btn_agregarProfesor').on('click', function(){

		if(j == 10){
			j = j;
		}else {
			$('#tableProfesor').clone().appendTo("#divProfesor");
			j++;
		}
});


$(document).on('click', '#btn_quitarProfesor', function(){
		//
		if(j == 1){
			j = j;
		}else {

			$(this).parent('td').parent('tr').remove()	;
			j--;
		}
});


$('#btn_agregarResponsable').on('click', function(){

		if(i == 5){
			i = i;
		}else {
			$('#tableResponsable').clone().appendTo("#divResponsable");
			i++;
		}
});

$(document).on('click', '#btn_quitarResponsable', function(){
		//
		if(i == 1){
			i = i;
		}else {

			$(this).parent('td').parent('tr').remove();

			i--;
		}
	});





