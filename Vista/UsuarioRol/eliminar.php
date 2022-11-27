<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['idusuario'])){
    $objC = new AbmUsuarioRol();
    $objEliminar = $objC->buscar($data);
    $arrEliminar[0] = ['idusuario'=>$data['idusuario'],
                        'idrol'=>$objEliminar[0]->ge];
    $respuesta = $objC->baja($arrEliminar[0]);
    if (!$respuesta){
        $mensaje = " La accion BAJA no pudo concretarse ";
    }
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>