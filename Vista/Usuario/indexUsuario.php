<?php
$Titulo = " Gestion de Usuarios";
include_once("../Estructura/header.php");
include_once("../../configuracion.php");
$datos = data_submitted();

$obj= new AbmUsuario();
$lista = $obj->buscar(null);
$url = basename(__FILE__);
$objMen = new AbmMenu();
if ($objMen->estaDeshabilitada($url)){
if ($objSession->tienePermisos($url)){
?>
<h3 style="margin-left:1%">ABM - Usuarios</h3>
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
        <a href="javascript:void(0)" iconCls="icon-add" class="easyui-linkbutton" onclick="newUsuario()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="editUsuario()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" onclick="deshabilitarUsuario()">Deshabilitar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="habilitarUsuario()">Habilitar</a>
    </div>
   
</div>

<div id="w" class="easyui-window" title="Usuario nuevo:" data-options="closed:true, iconCls:'icon-add'" style="width:610px;height:200px;padding:10px;">

        <form class="ff" method="post" name="ff" id="ff" style="margin-left:30%;" novalidate>
            <input id="idusuario" name ="idusuario" type="hidden" value="<?php echo count($lista) ?>" readonly data-options="required:true" >            
            
            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="nombre" class="control-label">Nombre:</label>
                        <div class="input-group">
                        <input id="usnombre" name="usnombre" type="text" class="easyui-textbox" data-options="required:true" >
                        </div>
                    </div>
                </div>
            </div>

        
            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="uspass" class="control-label">Pass:</label>
                        <div class="input-group">
                        <input id="uspass" name="uspass" type="password" class="easyui-textbox" required data-options="required:true">
                    </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 ">
                    <div class="form-group has-feedback">
                        <label for="usmail" class="control-label">Correo:</label>
                        <div class="input-group">
                        <input id="usmail" name="usmail" type="text" class="easyui-textbox"  required data-options="required:true">
                        </div>
                    </div>
                </div>
            </div>


  
     
    <a href="javascript:void(0)" class="easyui-linkbutton" id="editarus" iconCls="icon-add" plain="true" onclick="saveUsuario()">Confirmar </a>

    </form> 


</div>

  
<table id="dg" title="Lista de Usuarios" class="easyui-datagrid" style="width:900px;height:250px" url="listar.php" singleSelect="true">
        <thead>
        <tr>
        <th field="idusuario" width="100">ID</th>
        <th field="usnombre" width="200">Nombre</th>
        <th field="usmail" width="200">Mail</th>
        <th field="usdeshabilitado" width="200">Deshabilitado</th>
        <th field="usrol" width="200">Rol</th>
        </tr>
        </thead>
</table> 

<script type="text/javascript">
    var url;
    function newUsuario(){
        $('#ff').form('clear');
        $('#w').window('open');
        url = 'nuevo.php';
    }

    function editUsuario(){
        var row = $('#dg').datagrid('getSelected');

        if (row){
            $('#w').dialog('open').dialog('center').dialog('setTitle','Editar usuario');
            $('#ff').form('load',row);
            url = 'editar.php?idusuario='+row.idusuario;
        }
    }



    function saveUsuario(){
        //alert(" Accion");
        var pass = md5($('#uspass').val());
        $('input[name=uspass]').val(pass);

        $('#ff').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
            success: function(result){
            var result = eval('('+result+')');
            if (!result.respuesta){
                $('input[name=uspass]').val("");
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

    function deshabilitarUsuario(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Seguro que desea deshabilitar este usuario?', function(r){
            if (r){
                $.post('statusHabilitado.php?idusuario='+row.idusuario,
                function(result){
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

    function habilitarUsuario(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Seguro que desea habilitar este usuario?', function(r){
            if (r){
                $.post('statusHabilitado.php?idusuario='+row.idusuario+'&habilitar=si',
                function(result){
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
<?php 
}else{ 
    include_once "../error/error.php";
}
} else {
    include_once "../error/errorMe.php";
}

