<?php
    session_start();   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web|ZCOOL+XiaoWei" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css"> 
  <link rel="stylesheet" href="css/usuario.css">
  <style>
      div.a {
        text-align:center;
        height: 80px;
        border: 1px solid black;
        background-color: #2186C4; 
        
      }

      div.b {
          text-align:center;
          height: 30px;
          border: 1px solid black;
          font-size: 12px; 
      }

      div.c{
          text-align:center;
          height: 30px;
          border: 1px solid black;   
      }
      
      .btn-detalles{
          font-size: 10px;
          padding-left: 1px;
          text-align:center;
      }
  </style>
</head>
<body>
    <nav class="navbar d-flex justify-content-between p-2">
            <div class="col-3 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                <a class="" href="index.php">SGE</a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                <a href="#" class="">Cursos</a>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">

                <?php if(isset($_SESSION['usuario'])) :?> 
                    
                    <a href="usuario.php?usuario=<?php echo $_SESSION['usuario']?>" class=""><i class="fas fa-user mx-2 "></i>
                        <span> 
                            <?php echo $_SESSION['usuario']; ?>
                        </span>
                    </a>

                    <?php else : ?>
                    <a href="login.php" class=""><i class="fas fa-user mx-2 "></i>
                        <span>Iniciar Sesión</span>
                    </a>                   
        
                    <?php endif; ?>
            </div>
    
    </nav>

    <div class="container" id="contenedor">
        
        
    </div>
    <script src="js/curso/cursos.js"></script>
</body>
</html>
    
</body>
</html>