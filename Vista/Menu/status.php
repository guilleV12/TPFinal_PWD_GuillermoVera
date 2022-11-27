<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta=false;

if (isset($data['idmenu'])){
    $objC = new AbmMenu();
    $param['idmenu'] = $data['idmenu'];
    $objEliminar = $objC->buscar($param);

    if ($objEliminar[0]->getIdPadre() == null){
        $idpadre = null;
    }else{
        $idpadre = $objEliminar[0]->getIdPadre()->getIdPadre();
    }

    $arrEliminar[0] = ['idmenu'=>$objEliminar[0]->getIdMenu(), 
                        'menombre'=>$objEliminar[0]->getMeNombre(),
                        'medescripcion'=>$objEliminar[0]->getMeDescripcion(),
                        'idpadre'=>$idpadre,
                        'medeshabilitado'=>$objEliminar[0]->getMeDeshabilitado()];

    if (!isset($data['habilitar'])){
        $arrEliminar[0]['medeshabilitado']= date("Y-m-d h:i:s");
        $respuesta = $objC->modificacion($arrEliminar[0]);
        if (!$respuesta){
            $mensaje = " La accion  DESHABILITAR no pudo concretarse";
        }
    }else{
        $arrEliminar[0]['medeshabilitado']='0000-00-00 00:00:00';
        $respuesta = $objC->modificacion($arrEliminar[0]);
        if (!$respuesta){
            $mensaje = " La accion  HABILITAR no pudo concretarse";
        }
    } 
    
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>