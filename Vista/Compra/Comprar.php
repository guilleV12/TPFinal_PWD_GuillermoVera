<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$url = basename(__FILE__);
$objMen = new AbmMenu();
if ($objMen->estaDeshabilitada($url)){
if ($objSession->tienePermisos($url)){    
$obj = new AbmProducto();
$lista = $obj->buscar(null);
$data = data_submitted();
if (isset($data['tipo'])){
$variable = $data['tipo'];
switch ($variable) {
    case 'Camara':
        for ($i=0; $i < count($lista); $i++){
            if ($lista[$i]->getProDetalle() == "Camara"){
            if ($lista[$i]->getProCantStock() > 0){
        ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                    <img <?php echo 'src="../img/camara'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                Cantidad: <input type="text" id="cicantidad<?php echo $i+1; ?>" style="width:50px" name="cicantidad<?php echo $i+1; ?>">

                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton" onclick="nuevaCompra(<?php echo $lista[$i]->getIdProducto(); ?>,document.getElementById('cicantidad<?php echo $i+1; ?>').value)">Anadir al carrito</a>
                </div>
            </div>
            </div>
        
        <?php
        }else { ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                    <img <?php echo 'src="../img/camara'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton">No hay stock</a>
                </div>
            </div>
            </div>
            <?php
        }}}
        
        break;

    case 'Celular':
        for ($i=0; $i < count($lista); $i++){
            if ($lista[$i]->getProDetalle() == "Celular"){
            if ($lista[$i]->getProCantStock() > 0){
        ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                    <img <?php echo 'src="../img/celular'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                Cantidad: <input type="text" id="cicantidad<?php echo $i+1; ?>" style="width:50px" name="cicantidad<?php echo $i+1; ?>">

                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton" onclick="nuevaCompra(<?php echo $lista[$i]->getIdProducto() ?>,document.getElementById('cicantidad<?php echo $i+1; ?>').value)">Anadir al carrito</a>
                </div>
            </div>
            </div>
        
        <?php
        }else { ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                    <img <?php echo 'src="../img/celular'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton">No hay stock</a>
                </div>
            </div>
            </div>
            <?php
        }
        }}
        

    break;

    case 'TV':
        for ($i=0; $i < count($lista); $i++){
            if ($lista[$i]->getProDetalle() == "TV"){
                if ($lista[$i]->getProCantStock() > 0){
        ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                        <img <?php echo 'src="../img/TV'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                Cantidad: <input type="text" id="cicantidad<?php echo $i+1; ?>" style="width:50px" name="cicantidad<?php echo $i+1; ?>">
                    
                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton" onclick="nuevaCompra(<?php echo $lista[$i]->getIdProducto() ?>,document.getElementById('cicantidad<?php echo $i+1; ?>').value)">Anadir al carrito</a>
                </div>
            </div>
            </div>
        
        <?php
                }else { ?>
                    <div class="row">
                     <div class="col-2">
                     </div>
                        <div class="col-4">
                        <div class="card m-4" style="width: 18rem;height:200px">
                            <div class="card-body">
                            <img <?php echo 'src="../img/TV'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                                <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"></h6>
                                <p class="card-text"></p>
                            </div>
                        </div>
                        </div>
                        <div class="col-4" style="margin-left:-100px;margin-top:150px">
                        <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton">No hay stock</a>
                        </div>
                    </div>
                    </div>
                    <?php
                }
        }}
        

    break;

    case 'PC':
        for ($i=0; $i < count($lista); $i++){
            if ($lista[$i]->getProDetalle() == "PC"){
                if ($lista[$i]->getProCantStock() > 0){
        ?>
            <div class="row">
             <div class="col-2">
             </div>
                <div class="col-4">
                <div class="card m-4" style="width: 18rem;height:200px">
                    <div class="card-body">
                        <img <?php echo 'src="../img/PC'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                        <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"></h6>
                        <p class="card-text"></p>
                    </div>
                </div>
                </div>
                <div class="col-4" style="margin-left:-100px;margin-top:150px">
                Cantidad: <input type="text" id="cicantidad<?php echo $i+1; ?>" style="width:50px" name="cicantidad<?php echo $i+1; ?>">

                <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton" onclick="nuevaCompra(<?php echo $lista[$i]->getIdProducto() ?>,document.getElementById('cicantidad<?php echo $i+1; ?>').value)">Anadir al carrito</a>
                </div>
            </div>
            </div>
        
        <?php
                }else { ?>
                    <div class="row">
                     <div class="col-2">
                     </div>
                        <div class="col-4">
                        <div class="card m-4" style="width: 18rem;height:200px">
                            <div class="card-body">
                            <img <?php echo 'src="../img/PC'.($i+1).'.PNG"'; ?> style="width:100px;height:100px;float:left">
                                <h5 class="card-title"><?php echo $lista[$i]->getProNombre(); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"></h6>
                                <p class="card-text"></p>
                            </div>
                        </div>
                        </div>
                        <div class="col-4" style="margin-left:-100px;margin-top:150px">
                        <a href="javascript:void(0)" style="margin-right:10px !important" class="easyui-linkbutton">No hay stock</a>
                        </div>
                    </div>
                    </div>
                    <?php
                }
        }}
    break;
    
    default:
        # code...
        break;
    }
}else{ ?>
<div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top w3-center"><code>No selecciono ningun tipo de producto</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="w3-center w3-animate-right"></h3>
    <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
    <h6 class="w3-center w3-animate-zoom"></h6>
    </div>

<?php
}
?>
<script type="text/javascript">
  function nuevaCompra(prod,cant){
    var url = 'nuevaCompra.php?idproducto='+prod+'&cicantidad='+cant;
    var idproducto = prod;
    console.log(cant);
    $.get(url, function(e){
    // algo que quieras hacer despues de enviar la petición.
    console.log(e);
        var e = eval('('+e+')');
        if (!e.respuesta){
            $.messager.show({
                title: 'Error',
                msg: e.errorMsg
            });
        }
        
    });


  }
</script>
<?php
}else { 
    include_once "../error/error.php";

}
}else {
    include_once "../error/errorMe.php";
}

?>


