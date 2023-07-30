<?php
session_start(); 
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
if($_SESSION["loggedIn"] == false) {
  header("location: ../../principal/Home");
}
if (isset($_POST['find'])) {

  $busqueda = $_POST["nomDomain"];

  $data = array("remoteAddress" => $busqueda);

  $ch = curl_init("https://www.yougetsignal.com/tools/whois-lookup/php/get-whois-lookup-json-data.php");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

  $response = curl_exec($ch);
  $arrayData = json_decode($response, true);

  $disponible = $arrayData['domainAvailable'];
  $buscado = $arrayData['remoteAddress'];

  header("location: SearchClient?status=$disponible&found=$buscado");
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
    <title>ChibchaWeb | Dominios</title>
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
  <div class="img_back">
    <div class="left">
      <div>
        <span>ENCUENTRA</span>
      </div>
      <div>
        <span>EL MEJOR</span>
      </div>
      <div>
        <span>DOMINIO</span>
      </div>
    </div>
    <form action="" method="POST" class="inputTxt">
      <div>
        <p class="text-center">¿Buscando ese dominio perfecto? ¡Captura todos tus nombres de dominio ideales con el verificador de dominio!</p>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-5">
          <input type="text" name="nomDomain" id="nomDomain" class="form-control" placeholder="Escribe el nombre del dominio" required>
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-danger btn-find" name="find">Buscar</button>
        </div>
        <div class="col-3"></div>
      </div>
    </form>
  </div>
</div>
<div class="container">
  <div class="row opts">
    <div class="col-3"></div>
    <div class="col-1 text-center lineR" onclick="changeName('.com');">
      <span>.com</span>
      <p>$ 8.99</p>
    </div>
    <div class="col-1 text-center lineR" onclick="changeName('.xyz');">        
      <span>.xyz</span>
      <p>$ 0.99</p>
    </div>
    <div class="col-1 text-center lineR" onclick="changeName('.online');">
      <span>.online</span>
      <p>$ 0.99</p>
    </div>
    <div class="col-1 text-center lineR" onclick="changeName('.tech');">
      <span>.tech</span>
      <p>$ 0.99</p>
    </div>
    <div class="col-1 text-center lineR" onclick="changeName('.sitio');">
      <span>.sitio</span>
      <p>$ 0.99</p>
    </div>
    <div class="col-1 text-center" onclick="changeName('.space');">
      <span>.space</span>
      <p>$ 0.89</p>
    </div>
    <div class="col-3"></div>
  </div>
  <div class="row top3">
    <div class="col-1"></div>
    <div class="col-5">
      <div class="row bord">
        <div class="col-6">
          <img src="../../../Data/imgs/.com" class="imgDom" onclick="location.href=''">
        </div>
        <div class="col-6">
          <p>El dominio más popular del mundo.</p>
          <span>Obtenlo por un precio de <b>$9.99 al año</b></span>
        </div>
      </div>
    </div>
    <div class="col-5">
      <div class="row bord">
        <div class="col-6">
          <img src="../../../Data/imgs/.net.png" class="imgDom" onclick="location.href=''">
        </div>
        <div class="col-6">
          <p>El dominio para empresari@s.</p>
          <span>¡Disponible ahora! por <b>$12.99 al año</b></span>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
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
<script type="text/javascript">
  function changeName(text) {
    var inp = document.getElementById("nomDomain").value;
    if (inp == "") {
      document.getElementById("nomDomain").value = text;
    } else {
      var split = inp.split(".");
      var nom = split[0];
      var ext = split[1];
      ext = text;
      document.getElementById("nomDomain").value = nom+text;
    }
  }
</script>