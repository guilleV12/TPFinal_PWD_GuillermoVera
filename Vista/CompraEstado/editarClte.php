<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false;
if (isset($data['idcompraestado'])){
    $objC = new AbmCompraEstado();
    $param['idcompraestado'] = $data['idcompraestado'];
    $objEliminar = $objC->buscar($param);
    if ($objEliminar[0]->getCeFechaFin() == "0000-00-00 00:00:00"){
    if ($objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 1){
            
        if ($data['idcompraestadotipo'] == 4){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo(),
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>date("Y-m-d h:i:s")];
            $respuesta = $objC->modificacion($arrEliminar[0]);

            if (!$respuesta){
                $mensaje = " Error update";
            }

            $listaCompEs = $objC->buscar(null);
            $arrNuevo[0] = ['idcompraestado'=>(count($listaCompEs)+1),
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>4,
                            'cefechaini'=>date('Y-m-d H:i:s'),
                            'cefechafin'=>date('Y-m-d H:i:s')];

            $respuesta = $objC->alta($arrNuevo[0]);
            if (!$respuesta){
                $mensaje = " Error insert";
            }
            
        }else{
            $mensaje = " El cliente solo puede cancelar su compra";
        }
    } else {
        $mensaje = " El cliente solo puede cancelar su compra si esta en en estado 'iniciada'";
    }
    } else{
        $mensaje = "El estado ha finalizado";    
    }   
    
}

$retorno['respuesta'] = $respuesta;
$retorno['data'] = $data;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>