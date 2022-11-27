<?php
    include_once '../../configuracion.php';

    $datos = data_submitted();
    $datos['uspass'] = ($datos['uspass']);
    $objSession = new Session();
    $objUsuario = new AbmUsuario();
    $listaUsuarios = $objUsuario->buscar(null);
    $respuesta = false;
    $resp = false;
    for ($i=0; $i < count($listaUsuarios); $i++) { 
        if ($listaUsuarios[$i]->getUsNombre() == $datos['usnombre']){
            if ($listaUsuarios[$i]->getUsPass() == $datos['uspass']){
                $resp = true;
            }
        }
    }

    if ($resp == true){
        if ($objSession->activa()){
            $objSession->cerrar();
            $objSession = new Session();
            $objSession->iniciar($datos['usnombre'],$datos['uspass']);
            if ( $objSession->getUsuario()->getUsDeshabilitado() == "0000-00-00 00:00:00" ){
            if ($objSession->validar() == true){
                $objSession->setRol($objSession->getRol()->getRoDescripcion());
                $respuesta = 'paginaSegura.php';
                
            }
            }else{
                $error='index.php?error=2';
            }
        }else{
            $objSession->iniciar($datos['usnombre'],$datos['uspass']);
            if ($objSession->getUsuario()->getUsDeshabilitado() == "0000-00-00 00:00:00"){
            if ($objSession->validar() == true){
                $objSession->setRol($objSession->getRol()->getRoDescripcion());
                $respuesta = ':paginaSegura.php';
            }
            }else {
                $error=':index.php?error=2';
            }
        }
    } else {
        $error='index.php?error=1';
    }
$retorno['respuesta'] = $respuesta;
if (isset($error)){
    $retorno['error'] = $error;
}
echo json_encode($retorno);


   
?>