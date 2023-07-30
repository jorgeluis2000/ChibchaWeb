<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/ClienteDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/DistribuidorDAO.class.php');

if (isset($_SESSION["loggedIn"])) {
	if ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 2) {
    	header("location: ../modulos/Client/ProfileClient");
	}elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 1) {
		header("location: ../modulos/Admin/AdminHome");
	}elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 3) {
		header("location: ../modulos/Distributor/ProfileDistributor");
	}elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 4) {
		header("location: ../modulos/Employee/ProfileEmployee");
	}
}
if (isset($_POST["iniciar"])) {

	$correo = $_POST["cor"];
	$clave = $_POST["pas"];

	$usuarioDAO = new UsuarioDAO();
	$userProvi = $usuarioDAO->getUsuarioLogin($correo, $clave);
	if ($userProvi != null) {
		$numero = $userProvi->getCodigoUsuario();
		$_SESSION["loggedIn"] = true;
		$_SESSION["correo"] = $correo;
		$_SESSION["password"] = $clave;
		$_SESSION["loggedIn"] = $userProvi->getCodigoUsuario();
		$_SESSION["tipo"] = $userProvi->getCodigoTipoUsuario();
		if ($userProvi->getCodigoTipoUsuario() == 1) {
			header("location: ../modulos/Admin/AdminHome");
		}
		elseif ($userProvi->getCodigoTipoUsuario() == 2) {
			$clienteDao = new ClienteDAO();
			$cliente = $clienteDao->getClienteLogin($numero);
			$tip = $userProvi->getCodigoTipoUsuario();
			if ($cliente->getEstado() == 1) {
				header("location: ../modulos/Client/ProfileClient");
			}
			else {
				header("location: ChangePassword?tipo=$tip");
			}
		}
		elseif ($userProvi->getCodigoTipoUsuario() == 3) {
			$distribuidorDAO = new DistribuidorDAO();
			$distri = $distribuidorDAO->getDistribuidor($numero);
			$tip = $userProvi->getCodigoTipoUsuario();
			if ($distri->getEstado() == 1) {
				header("location: ../modulos/Distributor/ProfileDistributor");
			} elseif ($distri->getEstado() == 2) {
				header("location: ChangePassword?tipo=$tip");
			} else {
				echo("<script>alert('El administrador aún no ha aprobado tu solicitud de ingreso');</script>");
			}
		}
		elseif ($userProvi->getCodigoTipoUsuario() == 4) {
			header("location: ");
		}
		else {
			header("location: ");
		}
	}
	else {
		echo("<script>alert('Error, verifique los datos.');</script>");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ChibchaWeb | LogIn</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="../../Data/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Data/assets/multistepform/css/style.css" rel="stylesheet">
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
	<div class="row">
		<div class="col-2">
			<div class="contain-btn">
				<button class="btn btn-up1" onclick="location.href='Home'"><i class="fas fa-home icon"></i><b class="txt">| &nbsp Volver al Inicio</b></button>
			</div>
		</div>
		<div class="col-8"></div>
		<div class="col-2">
			<div class="contain-btn">
				<button class="btn btn-up2" onclick="location.href='Register'"><i class="fas fa-user-check icon"></i><b class="txt"> | &nbsp Registrarse</b></button>
			</div>
		</div>
	</div>
	<div class="row">
	    <div class="col-md-10 col-md-offset-1">
	        <form id="msform2" action="" method="POST">
	            <div class="row">
	            	<div class="col-1"></div>
	            	<div class="col-4 img">
	            		<img src="../../Data/imgs/ChibchaWeb.png">
	            	</div>
	            	<div class="col-1 bord"></div>
	            	<div class="col-1"></div>
	            	<div class="col-5">
	            		<fieldset>
			                <h2 class="fs-title">INICIO DE SESIÓN</h2>
			                <h3 class="fs-subtitle">Ingresa a ser parte de la experiencia</h3>
			                <input type="text" name="cor" placeholder="Correo electrónico" required/>
			                <input type="password" name="pas" placeholder="Contraseña" required/>
			                <input type="button" onclick="location.href='ForgetPassword'" class="action-button" value="Olvide mi contraseña"/>
			                <input type="submit" name="iniciar" class="action-button" value="Iniciar sesión"/>
			            </fieldset>
	            	</div>
	            </div>
	        </form>
	    </div>
	</div>
</div>
</body>
</html>