<?php
include_once ('../../configuracion.php');
$data = data_submitted();
$objControl = new AbmCompraEstado();
$lista = $objControl->buscar(null);
$arreglo_salida =  array();
foreach ($lista as $elem ){
    $paramcomp['idcompra'] = $elem->getIdCompra()->getIdCompra();
    $objCi = new AbmCompraItem();
    $listaCi = $objCi->buscar($paramcomp);
    $paramProd['idproducto']=$listaCi[0]->getIdProducto()->getIdProducto();
    $objP = new AbmProducto();
    $listaPr = $objP->buscar($paramProd);

    $nuevoElem['idcompraestado'] = $elem->getIdCompraEstado();
    $nuevoElem['idcompra'] = $elem->getIdCompra()->getIdCompra();
    $nuevoElem["idcompraestadotipo"]=$elem->getIdCompraEstadoTipo()->getCetDescripcion();
    $nuevoElem['cefechaini']= $elem->getCeFechaIni();
    $nuevoElem['cefechafin']= $elem->getCeFechaFin();

    array_push($arreglo_salida,$nuevoElem);
}
echo json_encode($arreglo_salida,null,2);

?>