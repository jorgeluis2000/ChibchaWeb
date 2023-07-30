<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
if ($_SESSION["loggedIn"] == false) {
	header("location: Home");
}
$tipo = $_GET['tipo'];
if (isset($_POST["actualizar"])) {

	$userDAO = new UsuarioDAO();
	$usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);

	$codigo = $usuario->getCodigoUsuario();
	$newPass = $_POST["conf"];

	$userDAO->UpdatePassword($codigo, $newPass, $tipo);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ChibchaWeb | Cambio contrase&ntildea</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="../../Data/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Data/assets/multistepform/css/style.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<link rel="stylesheet" href="../../Data/password/strength.css">
	<script src="../../Data/password/password_strength.js"></script>
	<script src="../../Data/password/jquery-strength.js"></script>
</head>
<body>
<style type="text/css">
html {
background: url(../../Data/imgs/5.jpeg);
background-size: cover;
background-repeat: no-repeat;
}
</style>
<div class="container-fluid">
	<div class="row topp">
	    <div class="col-md-10 col-md-offset-1">
	        <form id="msform2" action="" method="post" enctype="multipart/form-data">
	            <div class="row">
	            	<div class="col-1"></div>
	            	<div class="col-4 img">
	            		<img src="../../Data/imgs/security.png">
	            	</div>
	            	<div class="col-1 bord"></div>
	            	<div class="col-1"></div>
	            	<div class="col-5">
	            		<fieldset>
			                <h2 class="fs-title">CAMBIO DE CONTRASE&ntildeA</h2>
			                <h3 class="fs-subtitle">Escoge algo seguro para garantizar tu seguridad</h3>
			                <input type="password" class="check-seguridad" name="pass" placeholder="Contraseña nueva" required/>
			                <input type="password" class="check-seguridad space" name="conf" placeholder="Confirmar contraseña" required/>
			                <div class="space">
				                <input type="button" onclick="location.href='../../Controller/closeSession'" class="action-button" value="cancelar"/>
				                <input type="submit" name="actualizar" class="action-button" value="Cambiar contraseña"/>
				            </div>
			            </fieldset>
	            	</div>
	            </div>
	        </form>
	    </div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
jQuery(function($) {	
	$(".check-seguridad").strength({
		templates: {
    	toggle: '<div class="pos"><span class="size"><span class="glyphicon icono glyphicon-eye-open {toggleClass}"></span></span></div>'     
        },
		scoreLables: {
		empty: 'Vacío',
		invalid: 'Invalido',
        weak: 'Débil',
		good: 'Bueno',
		strong: 'Fuerte'
		}, 
		scoreClasses: {
		empty: '',
		invalid: 'label-danger',
		weak: 'label-warning',
		good: 'label-info',
		strong: 'label-success'
		},
	});
});
</script>