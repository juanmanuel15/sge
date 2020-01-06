function vacio(valor){
	var resp;
	if(valor.val() === ''){
		resp = true;
		valor.addClass('input-vacio');
	}else{
		resp = false;
		valor.removeClass('input-vacio');
	}

	return resp;
}

function mensaje(msg,t,div){
	div.empty();
	quitarClases();	

	msg_f = `<label class = "label-form-control" for = "div_msg_config">${msg}</label>`
	div.append(msg_f);
	if(t === "e"){
		div.addClass("alert");
		div.addClass("alert-danger");

	}else{
		div.addClass("alert");
		div.addClass("alert-success");
	}
}

function quitarClases(){
	$('#div_msg_config').removeClass("alert-danger");
	$('#div_msg_config').removeClass("alert-success");
	$('#div_msg_config').empty();
}


function procesarDatos(nU, nC, tR, tE, FI, FF, lE, lU, p, nD){
	var datos = {
		'nU' : nU.val(),
		'nC' : nC.val(),
		'tR': tR.val(),
		'tE': tE.val(),
		'FI': FI.val(),
		'FF': FF.val(),
		'lE': lE.val(),
		'lU': lU.val(),
		'p': p.val(),
		'nD' : nD.val()
	};

	return datos;

}

