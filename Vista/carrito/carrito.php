<?php
    include_once "../../configuracion.php";
    $objSession = new Session();


$url = basename(__FILE__);
if ($objSession->tienePermisos($url)){

      $objCompra = new AbmCompra();
      $paramIdUs['idusuario'] = $objSession->getUsuario()->getIdUsuario();
      $listaCompraUs = $objCompra->buscar($paramIdUs);

      foreach ($listaCompraUs as $compra){
        $paramComE['idcompra'] = $compra->getIdCompra();
        $objCompraE = new AbmCompraEstado();
        $listaCompraE = $objCompraE->buscar($paramComE);
          
          foreach ($listaCompraE as $compraE){
            if ($compraE->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 1 && $compraE->getCeFechaFin() == "0000-00-00 00:00:00"){
              $idcompraini['idcompra'] = $compraE->getIdCompra()->getIdCompra();
            }
          }
      }

      if (isset($idcompraini)){
        $objCompraI = new AbmCompraItem();
        $listaCompraI = $objCompraI->buscar($idcompraini);

        foreach ($listaCompraI as $comprai){
?>
          <div class="row">
                    <div class="col-2">
                    </div>
                      <div class="col-4">
                      <div class="card m-4" style="width: 18rem;height:150px">
                          <div class="card-body">
                              <h5 class="card-title"><?php 
                                echo $comprai->getIdProducto()->getProNombre();
                                ?><br><?php
                                echo "Cantidad: ".$comprai->getCiCantidad();
                              ?></h5>
                              <h6 class="card-subtitle mb-2 text-muted"></h6>
                              <p class="card-text"></p>
                          </div>
                      </div>
                      </div>
                    </div>
<?php
        }
?>
        <a href="../CompraEstado/indexCompEstClte.php" style="margin-left:130px">Ver estado de mis compras</a>
<?php
      }
    }else{
      include_once "../error/error.php";
    }

?>
