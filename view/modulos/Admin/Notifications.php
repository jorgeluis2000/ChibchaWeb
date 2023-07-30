<?php
    require "AdminHeader.php";
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');

    $usuarioDAO = new UsuarioDAO();
    $user = $usuarioDAO->getAllUsers();
?>

  <div class="container-fluid">
    
  </div>
<?php require "AdminFooter.php";?>