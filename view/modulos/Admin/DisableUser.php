<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/ClienteDAO.class.php');

    if(isset($_GET['cod_usuario'])){
        $codigo = $_GET['cod_usuario'];

        $clienteDAO = new ClienteDAO();
        $cliente = $clienteDAO->desactivarCliente($codigo);

        header("location: ../../modulos/Admin/UsersData");
    }
?>