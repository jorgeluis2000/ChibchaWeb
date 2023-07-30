<?php
session_start(); 
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
if($_SESSION["loggedIn"] == false) {
  header("location: ../../principal/Home");
}
$userDAO = new UsuarioDAO();
$usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);

$name = $usuario->getNombreUsuario();
$ape = $usuario->getApellidoUsuario();

$user = $name.' '.$ape;

$correo = $usuario->getCorreoUsuario();

$estado = "";
$status = $_GET['status'];
$buscado = $_GET['found'];

if ($status == "True") {
  $estado = 'SI';
} else if ($status == "False") {
  $estado = 'NO';
} else {
  $estado = 'N/A';
}
$prize;
$word = explode(".", $buscado);
$ext = $word[1];
if ($ext == 'es') {
  $prize = 2.01;
} elseif ($ext == 'org') {
  $prize = 1.48;
} elseif ($ext == 'co') {
  $prize = 2.49;
} elseif ($ext == 'net') {
  $prize = 1.57;
} elseif ($ext == 'com') {
  $prize = 1.38;
} elseif ($ext == 'site') {
  $prize = 3.34;
} elseif ($ext == 'io') {
  $prize = 5.03;
} elseif ($ext == 'space') {
  $prize = 2.55;
} elseif ($ext == 'xyz') {
  $prize = 1.25;
} elseif ($ext == 'tech') {
  $prize = 5.21;
} else {
  $prize = 2.68;
}
if (isset($_POST['pay'])) {
  $numero = $_POST['receptor'];
  $nombre = $_POST['nom'.$numero];
  $precio = $_POST['pre'.$numero];

  header("location: DomainPaymentClient?nom=$nombre&pre=$precio");
}
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
  <div class="container">
    <div class="row">
      <?php if ($estado == "NO") { ?>
        <div class="heads btn-danger">
          <span>Dominio tomado</span>
          <a href="../../principal/infoGeneral">Llama al 3102057439 para solicitar asistencia</a>
        </div>
      <?php } else { ?>
        <div class="heads btn-success">
          <span>Dominio disponible</span>
          <a href="../../principal/infoGeneral">Llama al 3102057439 para solicitar asistencia</a>
        </div>
      <?php } ?>
    </div>
    <div class="row marquito">
      <div class="col-6 buscado">
        <b><?php echo($buscado) ?></b>
        <br>
        <?php if ($estado == "NO") {?>
          <span>Este nombre de dominio ya se encuentra utilizado.</span>
        <?php } else { ?>
          <span>Este nombre de dominio esta totalmente disponible.</span>
        <?php } ?>
      </div>
      <div class="col-6 verificacion">
        <?php if ($estado == "NO") {?>
          <span><i class="fas fa-check"></i>Puedes contactarte con nuestro soporte, vía telefonica o por WhatsApp.</span><p></p>
          <span><i class="fas fa-check"></i>Usa la lista de sugerencias de dominios que te entregamos.</span>
        <?php } else { ?>
          <span><i class="fas fa-check"></i>Incluy protección básica privada.</span><p></p>
          <span><i class="fas fa-check"></i><?php echo($buscado); ?> es increible, tiene tan sólo <?php echo(strlen($buscado)); ?> caracteres.</span>
        <?php } ?>
      </div>
    </div>
    <?php if ($estado != "NO") { ?>
      <div class="hed btn-success text-center">
        <span>El costo mensual de este dominio es de <?php echo($prize); ?> US</span>
      </div>
    <?php } ?>
    <?php 
    if ($estado == "NO") {
      $new = explode(".", $buscado);
      $nuevo = $new[0];
      $domains = ['The-'.$nuevo.'.es',$nuevo.'space.org','My'.$nuevo.'pro.co',$nuevo.'global.net','Icon-'.$nuevo.'.com',$nuevo.'star.site','Info'.$nuevo.'.io',$nuevo.'app.space','Look'.$nuevo.'.xyz',$nuevo.'free.tech'];
      $prizes = [2.01,1.48,2.49,1.57,1.38,3.34,5.03,2.55, 1.25,5.21]; ?>
      <form method="POST" id="formDom">
        <?php for ($i=0; $i < sizeof($domains); $i++) { ?>
          <div class="row">
            <div class="suggest">
              <div class="row">
                <div class="col-4 first">
                  <span>Disponible</span><br>
                  <b><?php echo($domains[$i]); ?></b>
                  <input type="hidden" name="<?php echo('nom'.$i); ?>" value="<?php echo($domains[$i]); ?>">
                </div>
                <div class="col-4"></div>
                <div class="col-2 second">
                  <b><?php echo($prizes[$i].' US'); ?></b><br>
                  <span>Valor mensual</span>
                  <input type="hidden" name="<?php echo('pre'.$i); ?>" value="<?php echo($prizes[$i]); ?>">
                </div>
                <div class="col-2">
                  <button onclick="dom(<?php echo($i); ?>);" name="pay" class="btn btn-primary">Registrar dominio</button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <input type="text" hidden name="receptor" id="receptor">
      </form>
    <?php } else { ?>
      <div class="row justify-content-between fila">
        <div class="col-5 text-center">
            <h5>Regresa al buscador de dominio y escoge otro si aún no estás de acuerdo</h5>
            <hr>
            <button class="btn" onclick="location.href='DomainsClient'">Regresar a buscar</button>
        </div>
        <div class="col-5 text-center">
            <h5>Adquiere este dominio único para que puedas montar la página que tanto deseas</h5>
            <hr>
            <button class="btn" onclick="location.href='DomainPaymentClient?nom=<?php echo($buscado); ?>&pre=<?php echo($prize); ?>'">Comprar ahora</button>
        </div>
      </div>
    <?php } ?>
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
  function dom(num) {
    document.getElementById('receptor').value = num;
    document.getElementById('formDom').submit;
  }
</script>