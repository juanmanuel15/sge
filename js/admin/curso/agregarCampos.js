var i=1;
var j=1;
var k =1;
var l = 1;
var m = 1;


$(document).on('click', '#btn_agregarReq', function(){
	//console.log(l);
	
	if(l == 5){
		l = l;
	}else {
		$('#tableReq').clone().appendTo("#divReq");			
		l++;
	}
});


$(document).on('click', '#btn_quitarReq', function(){
		//console.log(l);
	if(l == 1){
		l = l;

	}else {

		$(this).parent('td').parent('tr').remove();
		l--;
	}
});


$(document).on('click', '#btn_agregarMaterial', function(){
	//console.log(m);
	if(m == 5){
		m = m;
	}else {
		$('#tableMaterial').clone().appendTo("#divMaterial");			
		m++;
	}
});

$(document).on('click', '#btn_quitarMaterial', function(){
		//console.log(m);
	if(m == 1){
		m = m;

	}else {

		$(this).parent('td').parent('tr').remove();
		m--;
	}
});


$(document).on('click', '#btn_agregarHorario', function(){
		//console.log(k);
		if(k == 10){
			k = k;
		}else {
			$('#tableHorario').clone().appendTo("#tableBodyHorario");			
			k++;
		}
});

$(document).on('click', '#btn_quitarHorario', function(){
		//console.log(k);
		if(k == 1){
			k = k;

		}else {

			$(this).parent('td').parent('tr').remove();
			k--;
		}
	});

$('#btn_agregarProfesor').on('click', function(){

		//console.log(j);
		if(j == 10){
			j = j;
		}else {
			$('#tableProfesor').clone().appendTo("#divProfesor");
			j++;
		}
});


$(document).on('click', '#btn_quitarProfesor', function(){
		//console.log(j);
		if(j == 1){
			j = j;
		}else {

			$(this).parent('td').parent('tr').remove()	;
			j--;
		}
});


$('#btn_agregarResponsable').on('click', function(){
//console.log(i);
		if(i == 5){
			i = i;
		}else {
			$('#tableResponsable').clone().appendTo("#divResponsable");
			i++;
		}
});

$(document).on('click', '#btn_quitarResponsable', function(){
		//console.log(i);
		if(i == 1){
			i = i;
		}else {

			$(this).parent('td').parent('tr').remove();

			i--;
		}
	});





