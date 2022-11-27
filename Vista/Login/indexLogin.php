<?php 
include_once ('../../configuracion.php');
include_once ('../Estructura/headerP.php');
   

$title = 'Iniciar sesion';
$data = data_submitted();

?>

<div class="container d-flex justify-content-center align-items-start text-center mt-20vh">
  <div class="text-center mx-auto" style="max-width:300px">

    <img class="mb-4" src="../img/logo.png" alt="logo" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>

    <form class="needs-validation" data-toggle="loginValidator" id="form-login" novalidate  method="post">
      <div class="form-group mb-3">
        <div class="input-group">
          <div class="input-group w-100">
            <span id="basic-addon1" class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
            </span>
          <input type="text" name="usnombre" id="usnombre" placeholder="Username" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="form-group mb-3">
        <div class="input-group">
          <div class="input-group w-100">
            <span id="basic-addon1" class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
            </svg>
            </span>
          <input type="password" name="uspass" id="uspass" placeholder="Password" class="form-control" required>
          </div>
        </div>
      </div>

      


      <a href="javascript:void(0)" class="easyui-linkbutton" id="editarusuariorol" iconCls="" plain="true" onclick="validar()">Iniciar sesión </a>

    </form>
  </div>

</div>
<!-- <button class="btn btn-primary btn-block mt-4" onclick="cod()" type="submit"><?php if ($objSession->validar()){ ?>Cambiar de usuario<?php }else { ?>Iniciar sesión<?php } ?></button> -->



<div id='resp' class="justify-content-center align-items-center  mt-5" style="display:none">
<!-- usuario y/o contraseña es incorrecto -->
<div class='alert alert-danger w-25 mx-auto d-flex justify-content-center align-items-center  mt-5' role='alert'>
usuario y/o contraseña es incorrecto
</div>
</div>

<script type="text/javascript">
 function validar(){
    var pass = md5($('#uspass').val());

    $('input[name=uspass]').val(pass);
    $('#form-login').form('submit',{
      url:'validarLogin.php',
      onSubmit: function(){
        return $(this).form('validate');
      },
      success: function (result){
        var result = eval('('+result+')');
        if (!result.respuesta){
          $('#resp').css('display','inline');
          $('input[name=uspass]').val("");
        }else{
          $(location).prop('href', 'paginaSegura.php');
        }
      }
    })
  }


</script>