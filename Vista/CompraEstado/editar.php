<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false; 
if (isset($data['idcompra'])){
    $objC = new AbmCompraEstado();
    $objEliminar = $objC->buscar($data);
    if ($objEliminar[0]->getCeFechaFin() == "0000-00-00 00:00:00"){
    if ($objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 1){
        if ($data['idcompraestadotipo'] == 2){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo(),
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>date("Y-m-d h:i:s")];
            $objP = new AbmProducto(); 
            $objCI = new AbmCompraItem();

            $listaCI = $objCI->buscar($arrEliminar[0]);
            $buscarProd['idproducto'] = $listaCI[0]->getIdProducto()->getIdProducto();
            $listaP = $objP->buscar($buscarProd);

        if ($listaP[0]->getProCantStock() >= $listaCI[0]->getCiCantidad()){ 

            $respuesta = $objC->modificacion($arrEliminar[0]);

            if (!$respuesta){
                $mensaje="error mod";
            }

            $listaCompEs = $objC->buscar(null);

            $arrAlta[0] = ['idcompraestado'=>(count($listaCompEs)+1),
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>2,
                            'cefechaini'=>date('Y-m-d H:i:s'),
                            'cefechafin'=>"0"];

            $respuesta = $objC->alta($arrAlta[0]);

            $objCompI = new AbmCompraItem();
            $paramidcomp['idcompra'] = $data['idcompra'];
            $listaCompI = $objCompI->buscar($paramidcomp);

            foreach($listaCompI as $compit){
                $objProd = new AbmProducto();
                $paramProd['idproducto'] = $compit->getIdProducto()->getIdProducto();
                $listaProd = $objProd->buscar($paramProd);

                    $modProd[0]['idproducto'] = $listaProd[0]->getIdProducto();
                    $modProd[0]['pronombre'] = $listaProd[0]->getPronombre();
                    $modProd[0]['prodetalle'] = $listaProd[0]->getProDetalle();
                    $modProd[0]['procantstock'] = (($listaProd[0]->getProCantStock())-($compit->getCiCantidad()));
        
                    $objProd->modificacion($modProd[0]);
                    if (!$objProd->modificacion($modProd[0])) {
                        $mensaje = " La accion MODIFICACION de stock no pudo ccretarse";
                    }
                
            }
            
            if (!$respuesta){
                $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }
        }else {
            $mensaje = "No hay suficiente stock para aceptar la compra";
        }
        } elseif ($data['idcompraestadotipo'] == 4){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo(),
                            'cefechaini'=>date("Y-m-d H:i:s"),
                            'cefechafin'=>date("Y-m-d h:i:sa")];
            $respuesta = $objC->modificacion($arrEliminar[0]);
            if (!$respuesta){
                $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }

            $listaCompEs = $objC->buscar(null);


            $arrNuevo[0]= ['idcompraestado'=>(count($listaCompEs)+1),
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>4,
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>date('Y-m-d H:i:s')];
            $respuesta = $objC->alta($arrNuevo[0]);
            if (!$respuesta){
                $mensaje = "el insert";
            }
        }else{
            $mensaje = " Una compra iniciada(1) solo puede aceptarse(2) o cancelarse(4)";
        }
    } else if($objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 2){
        if ($data['idcompraestadotipo'] == 3){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo(),
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>date("Y-m-d H:i:s")];
            $respuesta = $objC->modificacion($arrEliminar[0]);

            if (!$respuesta){
                $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }

            $listaCompEs = $objC->buscar(null);

            $arrNuevo[0] = ['idcompraestado'=>(count($listaCompEs)+1),
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>3,
                            'cefechaini'=>date('Y-m-d H:i:s'),
                            'cefechafin'=>"0"];

            $respuesta = $objC->alta($arrNuevo[0]);

            if (!$respuesta){
                $mensaje = 'el insert';
            }
        }elseif ($data['idcompraestadotipo'] == 4){

            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo(),
                            'cefechaini'=>date("Y-m-d H:i:s"),
                            'cefechafin'=>date("Y-m-d h:i:sa")];
            $respuesta = $objC->modificacion($arrEliminar[0]);
            if (!$respuesta){
                $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }

            $listaCompEs = $objC->buscar(null);


            $arrNuevo[0]= ['idcompraestado'=>(count($listaCompEs)+1),
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>4,
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>date('Y-m-d H:i:s')];
            $respuesta = $objC->alta($arrNuevo[0]);
            if (!$respuesta){
                $mensaje = "el insert";
            }

            $objCompI = new AbmCompraItem();
            $paramidcomp['idcompra'] = $data['idcompra'];
            $listaCompI = $objCompI->buscar($paramidcomp);

            foreach($listaCompI as $compit){
                $objProd = new AbmProducto();
                $paramProd['idproducto'] = $compit->getIdProducto()->getIdProducto();
                $listaProd = $objProd->buscar($paramProd);

                    $modProd[0]['idproducto'] = $listaProd[0]->getIdProducto();
                    $modProd[0]['pronombre'] = $listaProd[0]->getPronombre();
                    $modProd[0]['prodetalle'] = $listaProd[0]->getProDetalle();
                    $modProd[0]['procantstock'] = (($listaProd[0]->getProCantStock())+($compit->getCiCantidad()));
        
                    $objProd->modificacion($modProd[0]);
                    if (!$objProd->modificacion($modProd[0])) {
                        $mensaje = " La accion MODIFICACION de stock no pudo ccretarse";
                    }
                
            }
           
        } else{
            $mensaje = 'Una compra aceptada(2) solo puede enviarse (3) o cancelarse(4)';
        }
    } else if ($objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 3){
        if ($data['idcompraestadotipo'] == 4){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
            'idcompra'=>$data['idcompra'],
            'idcompraestadotipo'=>$objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo(),
            'cefechaini'=>date("Y-m-d H:i:s"),
            'cefechafin'=>date("Y-m-d h:i:sa")];
            $respuesta = $objC->modificacion($arrEliminar[0]);
            if (!$respuesta){
            $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }

            $listaCompEs = $objC->buscar(null);


            $arrNuevo[0]= ['idcompraestado'=>(count($listaCompEs)+1),
                        'idcompra'=>$data['idcompra'],
                        'idcompraestadotipo'=>4,
                        'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                        'cefechafin'=>date('Y-m-d H:i:s')];
            $respuesta = $objC->alta($arrNuevo[0]);
            if (!$respuesta){
            $mensaje = "el insert";
            }

            $objCompI = new AbmCompraItem();
            $paramidcomp['idcompra'] = $data['idcompra'];
            $listaCompI = $objCompI->buscar($paramidcomp);

            foreach($listaCompI as $compit){
                $objProd = new AbmProducto();
                $paramProd['idproducto'] = $compit->getIdProducto()->getIdProducto();
                $listaProd = $objProd->buscar($paramProd);

                    $modProd[0]['idproducto'] = $listaProd[0]->getIdProducto();
                    $modProd[0]['pronombre'] = $listaProd[0]->getPronombre();
                    $modProd[0]['prodetalle'] = $listaProd[0]->getProDetalle();
                    $modProd[0]['procantstock'] = (($listaProd[0]->getProCantStock())+($compit->getCiCantidad()));
        
                    $objProd->modificacion($modProd[0]);
                    if (!$objProd->modificacion($modProd[0])) {
                        $mensaje = " La accion MODIFICACION de stock no pudo ccretarse";
                    }
                
            }
        } else {
            $mensaje = "Una compra enviada(3) solo puede cancelarse(4)";
        }
    } else{
        $mensaje = "La compra ya fue cancelada(4)";
    }
}else{
    $mensaje = "El estado ya esta finalizado";
}
} 
    
    


$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>