<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$datos = data_submitted();
$url = basename(__FILE__);
$objMen = new AbmMenu();
if ($objMen->estaDeshabilitada($url)){
if ($objSession->tienePermisos($url)){
$obj= new AbmUsuarioRol();
$objU = new AbmUsuario();
$objR = new AbmRol();
$listaR = $objR->buscar(null);
$listaUsuarios = $objU->buscar(null);
$lista = $obj->buscar(null);

?>
<h3 style="margin-left:1%">ABM - Usuario Rol</h3>
<div class="row float-left">
    <div class="col-md-12 float-left">
      <?php 
      if(isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
        echo $datos['msg'];
      } 
     ?>
    </div>
</div>


<div class="row float-right">

    <div class="col-md-12 " style="margin-left:1%;margin-bottom:1%">
        <a href="javascript:void(0)" iconCls="icon-add" class="easyui-linkbutton" onclick="newUsuarioRol()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="editUsuarioRol()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" onclick="eliminarUsuarioRol()">Eliminar</a>
    </div>
   
</div>

<div id="w" class="easyui-window" title="Usuario Rol nuevo:" data-options="closed:true, iconCls:'icon-add'" style="width:610px;height:300px;padding:10px;">

        <form class="ff" method="post" name="ff" id="ff" style="margin-left:30%;" novalidate>
        <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="idusuario" class="control-label">Usuario:</label>
                        <div class="input-group">
                        <select id="idusuario" name="idusuario" class="easyui" data-options="required:true" >
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($listaUsuarios as $usuario){  ?>
                                <option value='<?php echo $usuario->getIdUsuario() ?>' ><?php echo $usuario->getUsNombre() ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="idrol" class="control-label">Rol:</label>
                        <div class="input-group">
                        <select id="idrol" name="idrol" class="easyui" data-options="required:true" >
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($listaR as $rol){  ?>
                                <option value='<?php echo $rol->getIdRol() ?>' ><?php echo $rol->getRoDescripcion() ?></option>
                            <?php } ?>
                        </select> 
                        </div>
                    </div>
                </div>
            </div>
            

  
     
    <a href="javascript:void(0)" class="easyui-linkbutton" id="editarusuariorol" iconCls="icon-add" plain="true" onclick="saveRol()">Confirmar </a>

    </form>


</div>

  
<table id="dg" title="Lista de Roles" class="easyui-datagrid" style="width:705px;height:400px" url="listar.php" singleSelect="true">
        <thead>
        <tr>
        <th field="idusuario" width="100">ID Usuario</th>
        <th field="usnombre" width="200">Usuario</th>
        <th field="rodescripcion" width="200">Descripcion</th>
        <th field="idrol" data-options="hidden:true"></th>
        </tr>
        </thead>
</table> 

<?php 
}else { 
    include_once "../error/error.php";
} 
}else{
    include_once "../error/errorMe.php";
}
?>
 

<script type="text/javascript">
    var url;
    function newUsuarioRol(){
        $('#ff').form('clear');
        $('#w').window('open');
        url = 'nuevo.php';
    }

    function editUsuarioRol(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#w').dialog('open').dialog('center').dialog('setTitle','Editar usuario rol');
            $('#ff').form('load',row);
            url = 'editar.php?idusuario='+row.idusuario;
        }
    }

    function saveRol(){
        //alert(" Accion");
        $('#ff').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
            success: function(result){
            var result = eval('('+result+')');
            if (!result.respuesta){
                $.messager.show({
                title: 'Error',
                msg: result.errorMsg
            });
            } else {
                    alert("Listo!");        
                    $('#w').window('close');        // close the dialog
                    $('#dg').datagrid('reload');    // reload 
                    }
                }
        });
    }

    function eliminarUsuarioRol(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Seguro que desea eliminar este usuario rol?', function(r){
            if (r){
                console.log(idrol);
                $.post('eliminar.php?idusuario='+row.idusuario+'&idrol='+row.idrol,
                function(result){
                var result = eval('('+result+')');
                if (result.respuesta){
                    $('#dg').datagrid('reload');    // reload the  data
                } else {
                    $.messager.show({    // show error message
                    title: 'Error',
                    msg: result.errorMsg
                    });
                }
                },'json');
                alert("Listo!");   
                $('#dg').datagrid('reload');    // reload the  data
                        }
                    });
                }
    }

   
</script>

