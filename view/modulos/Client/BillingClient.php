<?php
session_start(); 
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/HostingClienteDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/DominiosDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/DistribuidorDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/HostingDAO.class.php');

if($_SESSION["loggedIn"] == false) {
  header("location: ../../principal/Home");
}
$userDAO = new UsuarioDAO();
$usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);

$name = $usuario->getNombreUsuario();
$ape = $usuario->getApellidoUsuario();

$user = $name.' '.$ape;

$correo = $usuario->getCorreoUsuario();

$ur = $usuario->getCodigoUsuario();

$hostingClienteDAO = new HostingClienteDAO();
$listaHost = $hostingClienteDAO->getHostingList($ur);

$dominiosDAO = new DominiosDAO();
$listaDom = $dominiosDAO->getDomainList($ur);

$distribuidorDAO = new DistribuidorDAO();
$hostingDAO = new HostingDAO();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChibchaWeb | Facturación</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../Data/css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:900&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light nav">
  <img class="navbar-brand logoNav" src="../../../Data/imgs/ChibchaWeb2.png" onclick="location.href='ProfileClient'">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="line"></div> 
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="ProfileClient"><span class="col">Inicio</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="HostingClient"><span class="col">Hosting</span></a>
      </li>
      <li class="nav-item">
      	<a class="nav-link" href="DomainsClient"><span class="col">Dominios</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="BillingClient"><span class="col">Facturación</span></a>
      </li>
    </ul>
    <ul class="navbar-nav navbar-right">
      <li>
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="search" placeholder="Busca usuarios o sitios ..." aria-label="Search">
          <button class="btn my-2 my-sm-0 move2" type="submit"><span class="txt">Buscar</span><i class="fas fa-search lupa"></i></button>
        </form>
      </li>
      <li class="nav-item dropdown move3">
        <i class="far fa-bell camp"></i>
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
          <div class="txt_perfil" onclick="location.href='MyProfileClient'">
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
<div class="container-fluid">
  <div class="row justify-content-between">
    <div class="col-5 bloque">
      <h4 class="text-center">Compras de dominios realizadas</h4>
      <hr>
      <div class="ovf"><br>
        <?php if (sizeof($listaDom) == 0) { ?>
          <h2 class="text-center">Aún no hay compras de hostings registradas a tu nombre.</h2>
          <i class="fas fa-user-secret "></i>
        <?php } else { for ($i=0; $i < sizeof($listaDom); $i++) { ?>
          <div class="row">
            <div class="col-6">
              <b class="form-control">Nombre del dominio:</b><br>
              <b class="form-control">Distribuidor asociado:</b><br>
              <b class="form-control">Precio de compra:</b><br>
              <b class="form-control">Plazo de pago:</b><br>
              <b class="form-control">Forma de pago:</b><br>
              <b class="form-control">Fecha de la compra:</b>
            </div>
            <div class="col-6">
              <span class="form-control"><?php echo($listaDom[$i]['nom_dominio']) ?></span><br>
              <?php $nomD = $userDAO->getUsuario($listaDom[$i]['cod_distribuidor']) ?>
              <span class="form-control"><?php echo($nomD->getNombreUsuario()); ?></span><br>
              <span class="form-control"><?php echo($listaDom[$i]['precio_dominio']) ?></span><br>
              <span class="form-control"><?php echo($listaDom[$i]['plazo_dominio']) ?></span><br>
              <span class="form-control"><?php echo($listaDom[$i]['pago_dominio']) ?></span><br>
              <span class="form-control"><?php echo($listaDom[$i]['fecha_dominio']) ?></span>
            </div>
          </div>
          <hr class="divider"><br>
        <?php } } ?>
      </div>
    </div>
    <div class="col-5 bloque">
      <h4 class="text-center">Compras de hostings realizadas</h4>
      <hr>
      <div class="ovf"><br>
        <?php if (sizeof($listaHost) == 0) { ?>
          <h2 class="text-center">Aún no hay compras de dominios registradas a tu nombre.</h2>
          <i class="fas fa-user-secret "></i>
        <?php } else { for ($i=0; $i < sizeof($listaHost); $i++) { ?>
        <div class="row">
          <div class="col-6">
            <b class="form-control">Tipo del plan:</b><br>
            <b class="form-control">Distribuidor asociado:</b><br>
            <b class="form-control">Valor mensual:</b><br>
            <b class="form-control">Tiempo de pago:</b><br>
            <b class="form-control">Forma de pago:</b><br>
            <b class="form-control">Fecha de la compra:</b><br>
          </div>
          <div class="col-6">
            <?php $host = $hostingDAO->getHosting($listaHost[$i]['cod_hosting']);
              $aux = $host->getDistribuidor();
              $val = $host->getValor();
              $tip = $host->getTipo();
              $us = $userDAO->getUsuario($aux); ?>
              <span class="form-control"><?php echo($tip); ?></span><br>
              <span class="form-control"><?php echo($us->getNombreUsuario()); ?></span><br>
              <span class="form-control"><?php echo($val); ?></span><br>
              <span class="form-control"><?php echo($listaHost[$i]['tiempo_pago']) ?></span><br>
              <span class="form-control"><?php echo($listaHost[$i]['cod_tipo_forma_pago']) ?></span><br>
              <span class="form-control"><?php echo($listaHost[$i]['fecha_pago']) ?></span>
            </div>
        </div>
        <hr class="divider"><br>
      <?php } } ?>
    </div>
  </div>
</div>
<div class="container-fluid foot">
  <div class="row">
    <div class="col-3 padd foot-1">
      <div class="bgImg">
        <img src="../../../Data/imgs/ChibchaWeb.png">
      </div>
    </div>
    <div class="col-9">
      <div class="row">
        <div class="col-6">
          <div class="row padd2">
            <p class="inf-8">Todo comienza con un gran dominio.</p>
            <hr>
            <div class="text-left col-12 grey">
              <p>LA MEJOR FORMA DE BUSCAR</p>
              <i class="fas fa-check"></i><span class="out">Consulta en tiempo real de los dominios</span><br>
              <i class="fas fa-check"></i><span class="out">Obten tu dominio según los mejores que hay</span>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="row padd2">
            <p class="inf-8">Todo comienza con un gran Hosting.</p>
            <hr>
            <div class="text-left col-12 grey">
              <p>LOS MEJORES SERVICIOS</p>
              <i class="fas fa-check"></i><span class="out">Gran variedad de herramientas a tu disposición</span><br>
              <i class="fas fa-check"></i><span class="out">Las mejores opciones a los mejores precios</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="row foots">
            <div class="col-1"></div>
            <div class="col-3">
              <i class="fas fa-info-circle"></i><span class="out cursor" onclick="location.href=''">Nosotros</span>
            </div>
            <div class="col-3">
              <i class="far fa-envelope-open"></i><span class="out cursor" onclick="location.href=''">Contacto</span>
            </div>
            <div class="col-3">
              <i class="fas fa-map-marker-alt"></i><span class="out cursor" onclick="location.href=''">Ubicación</span>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="row foots-2">
            <div class="col-4"></div>
            <div class="col-1">
              <i class="fab fa-twitter-square cursor"></i>
            </div>
            <div class="col-1">
              <i class="fab fa-facebook-square cursor"></i>
            </div>
            <div class="col-1">
              <i class="fab fa-google-plus-square cursor"></i>
            </div>
            <div class="col-1">
              <i class="fab fa-youtube-square cursor"></i>
            </div>
            <div class="col-4"></div>
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>