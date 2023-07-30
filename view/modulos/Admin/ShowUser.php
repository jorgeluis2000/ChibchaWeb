<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/ClienteDAO.class.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/SitioWebDAO.class.php');

    $usuarioDAO = new UsuarioDAO();
    $clienteDAO = new ClienteDAO();
    $sitioWebDAO = new SitioWebDAO();

    if(isset($_GET['cod_usuario'])){
        $usuario = $usuarioDAO->getUsuario($_GET['cod_usuario']);
        $cliente = $clienteDAO->getCliente($_GET['cod_usuario']);

        $codigo = $usuario->getCodigoUsuario();
        $nombre = $usuario->getNombreUsuario();
        $apellido = $usuario->getApellidoUsuario();
        $documento = $usuario->getDocumentoUsuario();
        $correo = $usuario->getCorreoUsuario();
        $telefono = $usuario->getTelefonoUsuario();
        $password = $usuario->getContraseniaUsuario();

        $pais = $cliente->getPais();
        $cod_sitio = $cliente->getSitio();
        $fecha = $cliente->getFecha();

        $sitio_web = $sitioWebDAO->getSitioWeb($cod_sitio);

        $nombre_web = $sitio_web->getNombreSitioWeb();
        $descripcion_Web = $sitio_web->getDescripcionSitioWeb();
        $tipo_web = $sitio_web->getTipoSitioWeb();
    }
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="../../../Data/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../Data/assets/multistepform/css/style.css" rel="stylesheet">

<div class="row">
	    <div class="col-md-6 col-md-offset-3">
	        <form id="msform">
	            <fieldset>
                <h2 class="fs-title">DATOS PERSONALES</h2>
                    <input type="text" name="id" id="id" placeholder="ID" value="<?php echo $codigo?>" readonly required />
	                <input type="text" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo $nombre?>" readonly required />
	                <input type="text" name="apellido" id="apellido" placeholder="Apellidos" value="<?php echo $apellido?>"readonly required/>
	                <input type="text" name="documento" id="documento" placeholder="Documento" value="<?php echo $documento?>"readonly required/>
                    <input type="text" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo?>"readonly required/>
	                <input type="text" name="telefono"id="telefono"  placeholder="Teléfono" value="<?php echo $telefono?>"readonly required/>
                    <input type="text" name="pais"id="pais"  placeholder="País" value="<?php echo $pais?>"readonly required/>

                    <h2 class="fs-title">SITIO WEB</h2>
                    <input type="text" name="codigo_sitio"id="codigo_sitio" placeholder="Código de sitio web" value="<?php echo $cod_sitio?>" readonly required/>
                    <input type="text" name="nombre_sitio"id="nombre_sitio" placeholder="Nombre de sitio web" value="<?php echo $nombre_web?>"readonly required/>
                    <input type="text" name="tipo_sitio"id="tipo_sitio" placeholder="Tipo de sitio web" value="<?php echo $tipo_web?>"readonly required/>
                    <input type="text" name="fecha"id="fecha" placeholder="Fecha de ingreso" value="<?php echo $fecha?>" readonly required/>
                    <textarea type="text" name="description" id="description" placeholder="Descripción"readonly required><?php echo $descripcion_Web?></textarea>

                    <input type="button" onClick="history.back()" class="action-button" value="Volver"/>
                </fieldset>
</div>

<?php require "AdminFooter.php"?>
