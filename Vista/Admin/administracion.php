<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$datos = data_submitted();


$obj= new AbmUsuario();
$lista = $obj->buscar(null);
$url = basename(__FILE__);
if ($objSession->tienePermisos($url)){
switch ($objSession->rolActual()) {
    case 'Administrador':
        ?>
       
        <div class="tab" style="margin-left:20%">
            <h4 style="margin-bottom:3%">Administracion del sitio: </h4>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Usuarios</a>
                <a href="../Usuario/indexUsuario.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a><br>
            </div>
            <div class="item2" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Roles</a>
                <a href="../Rol/indexRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Usuario Rol</a>
                <a href="../UsuarioRol/indexUsuarioRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Cambiar Rol</a>
                <a href="../UsuarioRol/cambiarRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
           
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Menus</a>
                <a href="../Menu/indexMenu.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Menu rol</a>
                <a href="../MenuRol/indexMenuRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Compra Estado</a>
                <a href="../CompraEstado/indexCompEst.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Productos</a>
                <a href="../Productos/indexProductos.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
        </div>
<?php
        break;

    case 'Cliente':
        ?>
        <div class="tab" style="margin-left:20%">
            <h4 style="margin-bottom:3%">Administracion de cuenta: </h4>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Datos cuenta</a>
                <a href="../Usuario/indexUsuarioClte.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a><br>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Estado de mis compras</a>
                <a href="../CompraEstado/indexCompEstClte.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Cambiar Rol</a>
                <a href="../UsuarioRol/cambiarRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
        </div>

<?php

        break;

    case 'Deposito':
        ?>
        <div class="tab" style="margin-left:20%">
            <h4 style="margin-bottom:3%">Administracion : </h4>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Productos</a>
                <a href="../Productos/indexProductos.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Cambiar Rol</a>
                <a href="../UsuarioRol/cambiarRol.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
            <div class="item1" style="margin-bottom:2%">
                <a href="#" style="margin-left:4%" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" disabled>Compra Estado</a>
                <a href="../CompraEstado/indexCompEst.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Ir</a>
            </div>
        </div>

<?php

        break;
    
    default:
        # code...
        break;
}
}else{
    include_once "../error/error.php";
}

?>