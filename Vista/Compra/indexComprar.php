<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");


$obj = new AbmMenu();
$lista = $obj->buscar(null);
$url = basename(__FILE__);
$objMen = new AbmMenu();
if ($objMen->estaDeshabilitada($url)){
if ($objSession->tienePermisos($url)){

$arraymenus = [];
if (count($lista) > 0) {
    for ($i = 0; $i < count($lista); $i++){
        if ($lista[$i]->getIdPadre() == null && $lista[$i]->getMeDeshabilitado() == '0000-00-00 00:00:00'){
            if ($lista[$i]->getMeNombre() == "indexComprar.php"){
                array_push($arraymenus,$lista[$i]);
            }
        }
    }

foreach ($arraymenus as $menu){
$objMR = new AbmMenuRol();
$idmenu['idmenu'] = $menu->getIdMenu();
$listaMR = $objMR->buscar($idmenu);
if (count($listaMR) > 0){
?>

<div class="row" style="margin-top:5%">
     <div class="col-4">
     </div>
        <div class="col-4" style="background-color:#3C99DC;border-radius:1%;padding-left:6%">
        <div class="card m-4" style="width: 18rem;">
            <div class="card-body" style="padding-left:30%">
                <h5 class="card-title">Productos</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text"></p>
                <a href="#" class="easyui-menubutton" data-options="menu:'#mm1'">Categorias</a>
                <div id="mm1" style="width:150px;">
                <?php 
                    foreach($lista as $submenus){
                        if ($submenus->getIdPadre() != null && $submenus->getMeDeshabilitado() == '0000-00-00 00:00:00'){
                            if ($submenus->getIdPadre()->getIdMenu() == $menu->getIdMenu()){
                            ?>
                            <div data-options="iconCls:'icon-undo'"><a href="<?php echo $submenus->getMeDescripcion() ?>"><?php echo $submenus->getMeNombre() ?></a></div>
                            <div class="menu-sep"></div>
                            <?php }
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        </div>


<?php 
    
}}} 
}else{
    include_once "../error/error.php";
}
} else {
    include_once "../error/errorMe.php";
}
 ?>