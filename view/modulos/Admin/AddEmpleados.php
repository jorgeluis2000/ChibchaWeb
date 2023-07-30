<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/EmpleadoDAO.class.php');

if (isset($_POST["registro"])) {

	$nomUsuario = $_POST["nom"];
	$apeUsuario = $_POST["ape"];
	$docUsuario = $_POST["doc"];
	$corUsuario = $_POST["cor"];
	$telUsuario = $_POST["tel"];
    $paisUsuario = $_POST["pais"];
    $cod_tipo_empleado = $_POST["cargo"];
	
	$empleadoDAO = new EmpleadoDAO();
	$empleadoDAO->saveEmpleado($nomUsuario, $apeUsuario, $docUsuario, $corUsuario, $telUsuario, $paisUsuario,$cod_tipo_empleado);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ChibchaWeb | Registro</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="../../../Data/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../Data/assets/multistepform/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-2">
			<div class="contain-btn">
				<button class="btn btn-up1" onClick="history.back()"> <i class="fas fa-home icon"></i><b class="txt">| &nbsp Volver al Inicio</b></button>
			</div>
		</div>
		<div class="col-8"></div>
		<div class="col-2">
			<div class="contain-btn">
				
			</div>
		</div>
	</div>
	<div class="row">
	    <div class="col-md-6 col-md-offset-3">
	        <form id="msform" action="" method="post" enctype="multipart/form-data">
	            <ul id="progressbar">
	                <li class="active">Información Personal</li>
	                <li>Información Básica</li>
	                <li>Tipo de Empleado</li>
	            </ul>
	            <fieldset>
	                <h2 class="fs-title">DETALLES BÁSICOS</h2>
	                <input type="text" name="nom" placeholder="Nombres" required/>
	                <input type="text" name="ape" placeholder="Apellidos" required/>
	                <input type="text" name="doc" placeholder="Documento" required/>
	                <input type="button" name="next" class="next action-button" value="Siguiente"/>
	            </fieldset>
	            <fieldset>
	                <h2 class="fs-title">DETALLES PERSONALES</h2>
	                <input type="text" name="cor" placeholder="Correo electrónico" required/>
	                <input type="text" name="tel" placeholder="Teléfono" required/>
	                <input type="text" name="pais" placeholder="País" required/>
	                <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
	                <input type="button" name="next" class="next action-button" value="Siguiente"/>
	            </fieldset>
	            <fieldset>
	                <h2 class="fs-title">Cargo</h2>
	              
	                <div class="row">
                    <select name="cargo" id="cargo" class="form-control" >
                    <option value="1" selected>Técnico</option>
                    </select>
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
<script src="../../../Data/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../../Data/assets/multistepform/js/msform.js"></script>
</body>
</html>
