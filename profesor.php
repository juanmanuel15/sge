
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Códigos fuentes externos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../bibliotecas/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../bibliotecas/css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../bibliotecas/css/bootstrap-reboot.min.css">
    



    <title>LogIn</title>
    <style>
        
        div > ul {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contenedor {
        	background-color: rgba(0,0,0,0.8);
        }

        .formularioImagen {
        	height: 200px;
        	width: 100px;
        }
		
		.mensaje-error{
			background-color: red;

		}
        
        
    </style>
</head>
<body >
    <div class="container">
	
    <div class="row d-flex justify-content-center ">
    	<div class="col-12 col-sm-8 col-md-8 col-lg-6 mt-4 d-flex justify-content-center" >
    		<img src="../img/usuario.svg" alt="" class="col-sm-6 col-6 col-md-6 col-lg-4">
    	</div>
    </div>    	     
        <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="row d-flex justify-content-center mt-5">                
                <div class="col-lg-5 col-sm-12">
                    <div class="input-group">
                        <div class="input-group-prepend d-flex justify-content-center">
                            <span class="input-group-text far fa-user"></span>
                        </div>
                        <input type="text" placeholder= "Usuario" class="form-control" name = "usuario">
                    </div>

                    <div class="input-group mt-2">
                        <div class="input-group-prepend d-flex justify-content-center">
                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="password" placeholder= "Contraseña" class="form-control" name = "pass">
                    </div>
                    <div class="row d-flex justify-content-center">
            			<div class="col-lg-12 col-sm-12 mt-4">
                    
			                <?php if($error != "") : ?>
			                    <ul class="alert-danger">
			                        <?php echo $error; ?>             
			                    </ul>

			                <?php endif; ?>
                    
            			</div>
        			</div>
                    <div class="row mt-4 d-flex justify-content-center">
                        <div class="col-sm-12 col-lg-12 d-flex justify-content-center">
                            <input type="submit" value="Ingresar" class = "btn btn-danger col-sm-12 col-lg-12">
                        </div>
                    </div>

                </div>

            </div>
        </form>

        
    </div>

    <script src = "../bibliotecas/js/bootstrap.min.js"></script>
    <!--script src = "../bibliotecas/js/bootstrap.bundle.js"></script-->
    
</body>
</html>