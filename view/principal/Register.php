<?php  
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/DistribuidorDAO.class.php');
session_start(); 

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
if (isset($_POST["registro"])) {

	$nomUsuario = $_POST["nom"];
	$apeUsuario = $_POST["ape"];
	$docUsuario = $_POST["doc"];
	$corUsuario = $_POST["cor"];
	$telUsuario = $_POST["tel"];
	$paisUsuario = $_POST["pais"];
	$nomWeb = $_POST["nomSite"];
	$desWeb = $_POST["desSite"];

	$tipWeb;
	if ($_POST["oth"] == "") {
		$tipWeb = $_POST["tipSite"];
	} else {
		$tipWeb = $_POST["oth"];
	}

	$val_img = $_FILES['logSite']['name'];
	$src_img = $_FILES['logSite']['tmp_name'];
	$ruta = $_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Data/Logos/'.$nomWeb.'_'.$val_img;
	$destino = "Data/Logos/".$nomWeb.'_'.$val_img;
	copy($src_img, $ruta);

	$usuarioDAO = new UsuarioDAO();
	$usuarioDAO->saveClient($nomUsuario, $apeUsuario, $docUsuario, $corUsuario, $telUsuario, $paisUsuario, $nomWeb, $desWeb, $tipWeb, $destino);
}
if (isset($_POST["distribuidor"])) {
	$nomDis = $_POST["nomD"];
	$nitDis = $_POST["nitD"];
	$corDis = $_POST["corD"];
	$telDis = $_POST["telD"];
	$urlDis = $_POST["urlD"];

	$val_img = $_FILES['imgD']['name'];
	$src_img = $_FILES['imgD']['tmp_name'];
	$ruta = $_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Data/Distributor/'.$val_img;
	$destino = "Data/Distributor/".$val_img;
	copy($src_img, $ruta);

	$distributorDAO = new DistribuidorDAO();
	$distributorDAO->saveDistribuidor($nomDis, $nitDis, $corDis, $telDis, $urlDis, $destino);
}
?>
<!DOCTYPE html>
<html lang="en" id="cont">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ChibchaWeb | Registro</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="../../Data/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Data/assets/multistepform/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:900&display=swap" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-2">
			<div class="contain-btn">
				<button class="btn btn-up1" onclick="location.href='Home'"><i class="fas fa-home icon"></i><b class="txt">| &nbsp Volver al Inicio</b></button>
				<button class="btn cont-btn" onclick="location.href='Register'"><i class="fas fa-reply"></i></button>
			</div>
		</div>
		<div class="col-8"></div>
		<div class="col-2">
			<div class="contain-btn">
				<button class="btn btn-up2" onclick="location.href='Login'"><i class="fas fa-user-check icon"></i><b class="txt"> | &nbsp Iniciar Sesión</b></button>
			</div>
		</div>
	</div>
	<div class="row justify-content-between" id="opt">
		<div class="col-4 opt">
			<img src="../../Data/imgs/cli.jpg">
			<h4>Registrarse como cliente</h4>
			<button onclick="select(1);" class="btn btn-primary">IR AHORA</button>
		</div>
		<div class="col-4 opt">
			<img src="../../Data/imgs/dis.jpg">
			<h4>Registrarse como distribuidor</h4>
			<button onclick="select(2);" class="btn btn-primary">IR AHORA</button>
		</div>
	</div>
	<div class="row hid" id="dis">
	    <div class="col-md-6 col-md-offset-3">
	        <form id="msform" action="" method="post" enctype="multipart/form-data">
	            <ul id="progressbar">
	                <li class="active">Información Básica</li>
	                <li>Información de Contácto</li>
	                <li>Información de la Empresa</li>
	            </ul>
	            <fieldset>
	                <h2 class="fs-title">DETALLES BÁSICOS</h2>
	                <h3 class="fs-subtitle">Cuéntanos un poco de tí</h3>
	                <input type="text" name="nomD" placeholder="Nombre de la empresa" required/>
	                <input type="text" name="nitD" placeholder="Nit de la empresa" required/>
	                <input type="button" name="next" class="next action-button" value="Siguiente"/>
	            </fieldset>
	            <fieldset>
	                <h2 class="fs-title">DETALLES DE CONTÁCTO</h2>
	                <h3 class="fs-subtitle">Cuéntanos un poco de tí</h3>
	                <input type="text" name="corD" placeholder="Correo electrónico" required/>
	                <input type="text" name="telD" placeholder="Teléfono" required/>
	                <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
	                <input type="button" name="next" class="next action-button" value="Siguiente"/>
	            </fieldset>
	            <fieldset>
	                <h2 class="fs-title">DETALLES DE LA EMPRESA</h2>
	                <h3 class="fs-subtitle">Acerca de tu página web</h3>
	                <input type="text" name="urlD" placeholder="Url de la empresa" required/>
	                <p class="gr">Agrega el logo de tu empresa</p>
	                <input type="file" name="imgD" required/>
	                <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
	                <input type="submit" name="distribuidor" class="action-button" value="Registrar"/>
	            </fieldset>
	        </form>
	    </div>
	</div>
	<div class="row hid" id="cli">
	    <div class="col-md-6 col-md-offset-3">
	        <form id="msform" action="" method="post" enctype="multipart/form-data">
	            <ul id="progressbar">
	                <li class="active">Información Básica</li>
	                <li>Información Personal</li>
	                <li>Información del Sitio Web</li>
	            </ul>
	            <fieldset>
	                <h2 class="fs-title">DETALLES BÁSICOS</h2>
	                <h3 class="fs-subtitle">Cuéntanos un poco de tí</h3>
	                <input type="text" name="nom" placeholder="Nombres" required/>
	                <input type="text" name="ape" placeholder="Apellidos" required/>
	                <input type="text" name="doc" placeholder="Documento" required/>
	                <input type="button" name="next" class="next action-button" value="Siguiente"/>
	            </fieldset>
	            <fieldset>
	                <h2 class="fs-title">DETALLES PERSONALES</h2>
	                <h3 class="fs-subtitle">Cuéntanos un poco de tí</h3>
	                <input type="text" name="cor" placeholder="Correo electrónico" required/>
	                <input type="text" name="tel" placeholder="Teléfono" required/>
	                <input type="text" name="pais" placeholder="País" required/>
	                <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
	                <input type="button" name="next" class="next action-button" value="Siguiente"/>
	            </fieldset>
	            <fieldset>
	                <h2 class="fs-title">DETALLES DE TU SITIO</h2>
	                <h3 class="fs-subtitle">Acerca de tu página web</h3>
	                <input type="text" name="nomSite" placeholder="Nombre" required/>
	                <textarea type="text" name="desSite" placeholder="Descripción" required></textarea>
	                <div class="row">
	                	<div class="col-6">
	                		<select name="tipSite" required>
	                			<option value="0">Escoge una categoría</option>
	                			<option value="Comunicaciones">Comunicaciones</option>
								<option value="Deportes">Deportes</option>
								<option value="Economía">Alimentación</option>
								<option value="Entretenimiento">Entretenimiento</option>
	                			<option value="Gastronomía">Gastonomía</option>
	                			<option value="Historia">Historia</option>
	                			<option value="Salud">Salud</option>
	                			<option value="Tecnología">Tecnología</option>
	                		</select>
	                		<input type="text" name="oth" placeholder="Otra ...">
	                	</div>
	                	<div class="col-6">
	                		<span>Logo de la empresa</span>
	                		<input type="file" name="logSite" required>
	                	</div>
	                </div>
	                <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
	                <input type="submit" name="registro" class="action-button" value="Registrar"/>
	            </fieldset>
	        </form>
	    </div>
	</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../Data/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../Data/assets/multistepform/js/msform.js"></script>
</body>
</html>
<script type="text/javascript">
	function select(num) {
		document.getElementById('opt').style.display = 'none';
		document.querySelector('.cont-btn').style.display = 'block';
		if (num == 1) {
			document.getElementById('cli').style.display = 'block';
		} else {
			document.getElementById('dis').style.display = 'block';
		}
		document.getElementById('cont').style.background = 'url(../../Data/imgs/5.jpeg)';
		document.getElementById('cont').style.backgroundSize = 'cover';
		document.getElementById('cont').style.backgroundRepeat = 'no-repeat';
	}
</script>