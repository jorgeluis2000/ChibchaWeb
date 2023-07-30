<?php
    session_start();
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
    if($_SESSION["loggedIn"] == false) {
      header("location: ../../principal/Home");
    }
    $userDAO = new UsuarioDAO();
    $usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);

    $name = $usuario->getNombreUsuario();
    $ape = $usuario->getApellidoUsuario();

    $user = $name.' '.$ape;

    $correo = $usuario->getCorreoUsuario();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChibchaWeb | Administrador</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.jqueryui.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../Data/css/admin.css">
</head>
<body>
<!-- Bootstrap NavBar -->
<nav class="navbar navbar-expand-lg navbar-light nav">
  <img class="navbar-brand logoNav" src="../../../Data/imgs/ChibchaWeb2.png" onclick="location.href='ProfileClient'">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="line"></div>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

    </ul>
    <ul class="navbar-nav navbar-right">
      <li class="nav-item dropdown move3">
        <i class="far fa-bell camp" onclick="location.href='Notifications'"></i>
        <i class="fas fa-user-circle camp" id="navbarDropdown" role="button" data-toggle="dropdown"></i>
        <div class="dropdown-menu move" aria-labelledby="navbarDropdown">
          <div class="row cuadro">
            <div class="col-2">
              <i class="fas fa-user-circle icon"></i>
            </div>
            <div class="col-10">
              <p class="txt"><b><?php echo($user); ?></b></p>
              <p class="top2"><?php echo($correo); ?></p>
            </div>
          </div>
          <div class="dropdown-divider hr"></div>
          <div class="txt_perfil" onclick="location.href='../../modulos/Client/MyProfileClient'">
            <i class="fas fa-user-cog icon_a"></i><span>Mi perfil</span>
          </div>
          <div class="txt_perfil">
            <i class="far fa-bell icon_b"></i><span>Notificaciones</span>
          </div>
          <div class="dropdown-divider hr"></div>
          <button class="btn btn-danger color1" style="float: right;" onclick="location.href='../../../Controller/closeSession'"><span>Cerrar Sesión</span><i class="fas fa-sign-out-alt out"></i></button>
        </div>
      </li>
    </ul>
  </div>
</nav>


      <!-- This menu is hidden in bigger devices with d-sm-none.
           The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
      <li class="nav-item dropdown d-sm-block d-md-none">
        <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
            <a class="dropdown-item" href="#">Dashboard</a>
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Tasks</a>
            <a class="dropdown-item" href="#">Etc ...</a>
        </div>
      </li><!-- Smaller devices menu END -->

    </ul>
  </div>
</nav><!-- NavBar END -->


<!-- Bootstrap row -->
<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>MENÚ PRINCIPAL</small>
            </li>
            <!-- /END Separator -->
            <!-- Menu with submenu -->
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">Usuarios</span>
                    <span class="fa fa-caret-down fa-fw mr-3"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="UsersData" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Listado</span>
                </a>
                <a href="DisabledUsers" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Deshabilitados</span>
                </a>

            </div>
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-address-book fa-fw mr-3"></span>
                    <span class="menu-collapsed">Empleados</span>
                    <span class="fa fa-caret-down fa-fw mr-3"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="EmpleadosData" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Listado</span>
                </a>
                <a href="DisabledEmpleados" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Deshabilitados</span>
                </a>
                <a href="AddEmpleados" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Registrar</span>
                </a>
            </div>

                 <!-- Menu with submenu -->
                 <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-server fa-fw mr-3"></span>
                    <span class="menu-collapsed">Distribuidores</span>
                    <span class="fa fa-caret-down fa-fw mr-3"></span>
                </div>
            </a>
            <div id='submenu3' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Listado</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Deshabilitados</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Solicitudes</span>
                </a>

            </div>




            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>REPORTES</small>
            </li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">Tickets</span>
                </div>
            </a>

            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->

            <a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Ocultar</span>
                </div>
            </a>
            <!-- Logo -->
            <li class="list-group-item logo-separator d-flex justify-content-center">
            <!--<img src="../../../Data/imgs/ChibchaWeb.png" width="50" height="50" />    -->
            </li>
        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->

    <!-- MAIN -->
    <div class="col">
