<?php
include_once ('../../configuracion.php');
$objSession = new Session();
$data = data_submitted();
$cEsta = new AbmCompraEstado();
$respuesta = false;
$objProducto = new AbmProducto();
$producto = $objProducto->buscar($data);
$hayiniciada = false;
if ($producto[0]->getProCantStock() >= $data['cicantidad']){
if (isset($data['idproducto'])){
    $objComp = new AbmCompra();
    $paramIdU['idusuario']=$objSession->getUsuario()->getIdusuario();
    $listaComp = $objComp->buscar($paramIdU);
    if (count($listaComp)>0){
        foreach($listaComp as $compra){
            $idcomp['idcompra'] = $compra->getIdCompra();
            $arrcestado = $cEsta->buscar($idcomp);
            if ($arrcestado[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 1){
     /**/           if ($arrcestado[0]->getCeFechaFin() == "0000-00-00 00:00:00"){
                        $hayiniciada = true;
                        $compraIni[0] = $compra->getIdCompra();

                }/**/
                
            }
        }
        if ($hayiniciada == true){
            $objCi = new AbmCompraItem();
            $listaCi = $objCi->buscar(null);
            $paramComI['idcompra'] = $compraIni[0];
            $listaCiUs = $objCi->buscar($paramComI);

            $mismoprod = false;
            foreach ($listaCiUs as $comprai) {
                if ($comprai->getIdProducto()->getIdProducto() == $data['idproducto']){
                    $mismoprod = true;
                    $idcompI[0] = $comprai->getIdCompraItem();
                    $cicantCi[0] = $comprai->getCiCantidad();
                }
            }


            if ($mismoprod == true){
                if ($cicantCi[0]+$data['cicantidad'] <= $producto[0]->getProCantStock()){
                    $compI=["idcompraitem"=>$idcompI[0],
                        "idproducto"=>$data['idproducto'],
                        "idcompra"=>$compraIni[0],
                        "cicantidad"=>($cicantCi[0]+$data['cicantidad'])];
                $respuesta = $objCi->modificacion($compI);
                if (!$respuesta){
                    $mensaje = "error modi cicant ".count($listaCiUs);
                }
                }else{
                    $mensaje = "No hay suficiente stock";
                }
                
            }else{
                $compI=["idcompraitem"=>(count($listaCi)+1),
                        "idproducto"=>$data['idproducto'],
                        "idcompra"=>$compraIni[0],
                        "cicantidad"=>$data['cicantidad']];
                $respuesta = $objCi->alta($compI);
                if (!$respuesta){
                    $mensaje = "error alta";
                }
            }
            
                
        } else {
            
            $listaCT = $objComp->buscar(null);
            $cantCompras = count($listaCT)+1;
            $nuevaCompra=["idcompra"=>$cantCompras,
                          "cofecha"=>date("Y-m-d H:i:s"),
                          "idusuario"=>$paramIdU['idusuario']];
            $respuesta = $objComp->alta($nuevaCompra);
            if (!$respuesta){
                $mensaje="error alta comp";
            }

            $objCompEs = new AbmCompraEstado();
            $listaCE= $objCompEs->buscar(null);
            $nuevaCE = ["idcompraestado"=>(count($listaCE)+1),
                        "idcompra"=>$cantCompras,
                        "idcompraestadotipo"=>1,
                        "cefechaini"=>date("Y-m-d H:i:s"),
                        "cefechafin"=>"0000-00-00 00:00:00"];
            $respuesta = $objCompEs->alta($nuevaCE);
            if (!$respuesta){
                $mensaje="error alta compe";
            }

            $objCi = new AbmCompraItem();
                $listaCi = $objCi->buscar(null);
                $compI=["idcompraitem"=>(count($listaCi)+1),
                        "idproducto"=>$data['idproducto'],
                        "idcompra"=>$nuevaCompra["idcompra"],
                        "cicantidad"=>$data['cicantidad']];
                $respuesta = $objCi->alta($compI);
                if (!$respuesta){
                    $mensaje="error alta ci ".print_r($compI);
                }
        }
        
        
    }else{
            $listaCT = $objComp->buscar(null);
            $cantCompras = count($listaCT)+1;
            $nuevaCompra=["idcompra"=>$cantCompras,
                          "cofecha"=>date("Y-m-d H:i:s"),
                          "idusuario"=>$paramIdU['idusuario']];
            $respuesta = $objComp->alta($nuevaCompra);

            $objCompEs = new AbmCompraEstado();
            $listaCE= $objCompEs->buscar(null);
            $nuevaCE = ["idcompraestado"=>(count($listaCE)+1),
                        "idcompra"=>$cantCompras,
                        "idcompraestadotipo"=>1,
                        "cefechaini"=>date("Y-m-d H:i:s"),
                        "cefechafin"=>"0000-00-00 00:00:00"];
            $listaCE = $objCompEs->alta($nuevaCE);

            $objCi = new AbmCompraItem();
                $listaCi = $objCi->buscar(null);
                $compI=["idcompraitem"=>(count($listaCi)+1),
                        "idproducto"=>$data['idproducto'],
                        "idcompra"=>$nuevaCompra["idcompra"],
                        "cicantidad"=>$data['cicantidad']];
                $respuesta = $objCi->alta($compI);

                if (!$respuesta){
                    $mensaje = "Error compra item ";
                }
    }

}
} else {
    $mensaje = " Lo sentimos, no tenemos suficientes productos en stock.";

}





$retorno['respuesta'] = $respuesta;
$retorno['obj'] = $data;
if (isset($mensaje)){
    
    $retorno['errorMsg']=$mensaje;
   
}
 echo json_encode($retorno);
?>