<?php
include_once("../../configuracion.php");
include_once("footer.php");
$objSession = new Session();
$objCompra = new AbmCompra();
$title = "TP final";
?>
<html lang="es">
<head>
    <link rel="icon" type="image/x-icon" href="../img/logo.png">

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

        if ($objSession->validar()){ ?>
        
          <a class="easyui-linkbutton" style="margin-left:850px !important;margin-right:10px !important;padding-top:10px" href="../Admin/administracion.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
          <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
          </svg>
          </a>
          <a href="javascript:void(0)" style="margin-right:10px !important;padding-top:10px" class="easyui-linkbutton" onclick="reloadCarrito(),$('#carrito').window('open')">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
          <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
          </svg>
          </a>
          <a class="btn btn-outline-primary" style="margin-right:0 !important" href="../Login/cerrarSesion.php" role="button">Cerrar sesion</a>
          <?php }else { ?>
            <a class="btn btn-outline-primary" style="margin-left: 950px !important;" href="../Login/indexLogin.php" role="button">Iniciar sesion</a>
          <?php }  ?>
        
      </div>
    </ul>
  </div>
</nav>


<div id="carrito" class="easyui-window" title="Mis compras" data-options="modal:true,closed:true" style="width:500px;height:600px;padding:10px;">
</div>




<script type="text/javascript">
  $('#carrito').window({
    top:20
  })

  function reloadCarrito(){
    $('#carrito').window('refresh','../carrito/carrito.php');
  }
</script>



<?php
if (!$objSession->validar()){
  ?>
  <script type="text/javascript">
    window.location.href='../Login/indexLogin.php';
  </script>
  <?php
}

