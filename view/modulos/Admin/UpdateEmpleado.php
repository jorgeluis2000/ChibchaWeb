<?php
    require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
    require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/ClienteDAO.class.php');
    require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/EmpleadoDAO.class.php');
    require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/TipoEmpleadoDAO.class.php');

    $usuarioDAO = new UsuarioDAO();
    $clienteDAO = new ClienteDAO();
    $empleadoDAO = new EmpleadoDAO();
    $tipoEmpleadoDAO = new TipoEmpleadoDAO();

    if(isset($_GET['cod_usuario'])){
        $usuario = $usuarioDAO->getUsuario($_GET['cod_usuario']);
        $cliente = $clienteDAO->getCliente($_GET['cod_usuario']);
        $empleado = $empleadoDAO->getEmpleado($_GET['cod_usuario']);
        

        $codigo = $usuario->getCodigoUsuario();
        $nombre = $usuario->getNombreUsuario();
        $apellido = $usuario->getApellidoUsuario();
        $documento = $usuario->getDocumentoUsuario();
        $correo = $usuario->getCorreoUsuario();
        $telefono = $usuario->getTelefonoUsuario();
        $password = $usuario->getContraseniaUsuario();

        $pais = $cliente->getPais();
        $fecha = $cliente->getFecha();

        $cod_tipo_empleado = $empleado->getTipo();

        $tipoEmpleado = $tipoEmpleadoDAO->getTipoEmpleado($cod_tipo_empleado);
        $tipo_empleado = $tipoEmpleado->getNombreTipoEmpleado();
    }

        if(isset($_POST['id'])){
            $codigo = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $documento = $_POST['documento'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $password = $_POST['password'];
            $pais = $_POST['pais'];
    
            $tipo_empleado = $_POST['cargo'];
    
            $empleado = $empleadoDAO->uploadEmpleado($codigo, $nombre, $apellido, $documento, $correo, $telefono, $tipo_empleado, $pais, $password);
            header("location: ../../modulos/Admin/EmpleadosData");
        }
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="../../../Data/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../Data/assets/multistepform/css/style.css" rel="stylesheet">

<div class="row">
	    <div class="col-md-6 col-md-offset-3">
	        <form id="msform" method="post" action="UpdateEmpleado">
	            <fieldset>
                <h2 class="fs-title">DATOS DE <?php echo $nombre?> </h2>
                    <input type="text" name="id" id="id" placeholder="ID" value="<?php echo $codigo?>" readonly required />
	                <input type="text" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo $nombre?>" required />
	                <input type="text" name="apellido" id="apellido" placeholder="Apellidos" value="<?php echo $apellido?>" required/>
	                <input type="text" name="documento" id="documento" placeholder="Documento" value="<?php echo $documento?>" required/>
                    <input type="text" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo?>" required/>
	                <input type="text" name="telefono"id="telefono"  placeholder="Teléfono" value="<?php echo $telefono?>" required/>
                    <input type="text" name="pais"id="pais"  placeholder="País" value="<?php echo $pais?>" required/>
                    <input type="text" name="password"id="password"  placeholder="Contraseña" value="<?php echo $password?>" readonly required/>
                    <input type="text" name="fecha"id="fecha" placeholder="Fecha de ingreso" value="<?php echo $fecha?>" readonly required/>

                    <select name="cargo" id="cargo" class="form-control">
                    <option value="1" selected><?php echo $tipo_empleado?></option>
                    </select>

                    <input type="submit" name="next" class="next action-button" value="Actualizar"/>
                    <input type="button" onClick="history.back()" class="action-button" value="Volver"/>
                </fieldset>
</div>

<?php require "AdminFooter.php"?>
