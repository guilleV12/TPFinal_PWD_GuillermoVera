<?php
include_once("../../configuracion.php");
include_once("footer.php");
$objSession = new Session();
$title = "TP final";
?>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Css/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../Css/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../Css/bootstrap-5.1.3-dist/css/bootstrap-utilities.css">
    <link rel="stylesheet" href="../Css/bootstrap-5.1.3-dist/css/bootstrap-reboot.css">
    <!-- JS validator -->
    <script src="../Js/validator.js" type="text/javascript"></script>
    <!-- JQuery easyui -->
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/demo/demo.css">
    <script type="text/javascript" src="../js/jquery-easyui-1.6.6/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery-easyui-1.6.6/jquery.easyui.min.js"></script>
    
    <!-- MD5 -->
    <script src="../Js/md5/md5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/core.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>TP Final</title>    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:-2%;margin-bottom:2%;padding:1%">
  <a class="navbar-brand" href="#">GV Productos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../Compra/indexComprar.php">Productos</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../home/contacto.php">Contacto</a>
      </li>
      <li class="nav-item">
      
      </li>
      <div class="d-flex mx-5" >

     
<?php
  if (!$objSession->validar()){
?>      
            <a class="btn btn-outline-primary" style="margin-left: 950px !important;" href="../Login/indexLogin.php" role="button">Iniciar sesion</a>
<?php
  }else{
?>
    <a class="btn btn-outline-primary" style="margin-left: 950px !important;" href="../Login/cerrarSesion.php" role="button">Cerrar sesion</a>
<?php
  }

?>
      </div>
    </ul>
  </div>
</nav>


       
<script type="text/javascript">
  $('#carrito').window({
    top:20
  })
</script>