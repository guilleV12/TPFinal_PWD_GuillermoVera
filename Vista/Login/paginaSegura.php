<?php
    include_once("../Estructura/header.php");
    include_once("../../configuracion.php");
    $objUsuario = new AbmUsuario();
    $usuario = $objSession->getUsuario();
    $url = basename(__FILE__);
if ($objSession->tienePermisos($url)){
?>
<div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top w3-center"><code>Bienvenido <?php echo $usuario->getUsNombre(); ?>!</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="w3-center w3-animate-right"></h3>
    <h3 class="w3-center w3-animate-zoom">Si posee mas de un rol y desea cambiarlo:</h3>
    <h6 class="w3-center w3-animate-zoom">Configuración->Cambiar Rol</h6>
    </div>



<?php
}else{
    include_once "../error/error.php";
}
?>
