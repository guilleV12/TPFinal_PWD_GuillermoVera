<?php
include_once "../../configuracion.php";
$data = data_submitted();
if (isset($data['idusuario'])){
    $objC = new AbmUsuario();
    $objEliminar = $objC->buscar($data);
    $arrEliminar[0] = ['idusuario'=>$data['idusuario'],
                        'usnombre'=>$data['usnombre'],
                        'uspass'=>$data['uspass'],
                        'usmail'=>$data['usmail'],
                        'usdeshabilitado'=>$objEliminar[0]->getUsDeshabilitado()];
    $respuesta = $objC->modificacion($arrEliminar[0]);
    if (!$respuesta){
        $mensaje = " La accion MODIFICACION No pudo concretarse";
    }
}

$retorno['respuesta'] = $respuesta;
$retorno['pass'] = $arrEliminar[0]['uspass'];
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>