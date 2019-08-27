$(document).ready(function(){
    var datos;
    vista_selects();
    vista_btn(0,1);


    $('#btn_verficar').on('click', function(){
        datos = obtenerDatos();

        if(datos != false){
            vista_btn(1,0);

        }else {
            vista_btn(0,1);
        }

        
    });



});


