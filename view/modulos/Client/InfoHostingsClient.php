<?php
session_start(); 
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/HostingDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/DistribuidorDAO.class.php');
if($_SESSION["loggedIn"] == false) {
  header("location: ../../principal/Home");
}

$hostDAO = new HostingDAO();
$userDAO = new UsuarioDAO();
$DistribuidorDAO = new DistribuidorDAO();

$usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);

$name = $usuario->getNombreUsuario();
$ape = $usuario->getApellidoUsuario();

$user = $name.' '.$ape;

$correo = $usuario->getCorreoUsuario();

$tipo = $_GET['type'];

$hostings;
if ($tipo != '0') {
  $hostings = $hostDAO->getListaHostingPlan($tipo);
}
$totales = $hostDAO->getListaHosting();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChibchaWeb | Hosting</title>
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
<div class="sky">
  <h1>Hosting para todos y para cada presupuesto...</h1>
  <p class="top10">Las soluciones de hosting de ChibchaWeb están hechas para brindar velocidad, confiabilidad y seguridad. Todo lo encontrarás aquí.</p>
  <p class="top2">Desde un hospedaje web básico a servidores dedicados asombrosamente rápidos.</p>
</div>
<?php if ($tipo == '0') { ?>
<div class="container">
  <input class="form-control" id="myInput" type="text" placeholder="Buscar">
  <div class="tab">
    <table class="table table-bordered table-striped">
      <tbody id="myTable">
        <?php 
        for ($k=0; $k < sizeof($totales); $k++) { 
            $distri = $userDAO->getUsuario($totales[$k]['cod_distribuidor']);
        ?>
        <tr>
          <td class="wt">
            <div class="row">
              <div class="col-3">
                <span class="div_hid"><?php echo($distri->getNombreUsuario()); ?></span>
                <span class="div_hid"><?php echo($totales[$k]['tipo_hosting']); ?></span>
                <img src="../../../<?php echo($distri->getImagenUsuario()); ?>" class="imgInfo1">
              </div>
              <div class="col-4">
                <?php
                  $dat = $totales[$k]['datos_hosting'];
                  $plans = $totales[$k]['cod_hosting'];
                  $points = explode(".", $dat);
                  $inf = explode(",", $points[1]);
                  for ($j=0; $j < $points[0]; $j++) { ?>
                    <i class="fas fa-circle"></i><span class="out mayus"><?php echo($inf[$j]); ?></span><br>
                  <?php } ?>
              </div>
              <div class="col-2">
                <?php 
                  $cate;
                  if ($totales[$k]['tipo_hosting'] == 'Oro') {
                    $cate = '../../../Data/imgs/medal1.jpg';
                  } else if ($totales[$k]['tipo_hosting'] == 'Plata') {
                    $cate = '../../../Data/imgs/medal2.jpg';
                  } else { $cate = '../../../Data/imgs/medal3.jpg'; } ?>
                <img src="<?php echo($cate); ?>" class="imgInfo">
              </div>
              <div class="col-3 text-center">
                <p>$ <?php echo($totales[$k]['valor_mensual']); ?> /mes</p>
                <button class="btn btn-success" onclick="location.href='HostingPaymentClient?plan=<?php echo($plans); ?>'">Comprar paquete</button>
              </div>
            </div>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php } else { ?>
<div class="container">
  <table class="table table-responsive tableRes">
    <tr>
      <?php
        for ($i=0; $i < sizeof($hostings); $i++) {
          $distribuidor = $userDAO->getUsuario($hostings[$i]['cod_distribuidor']);
      ?>
      <td class="padd2">
        <div class="box text-center navi">
          <div class="row">
            <div class="col-12">
              <img src="../../../<?php echo($distribuidor->getImagenUsuario()); ?>">
              <h5>CHIBCHA <span class="upper"><?php echo($tipo); ?></span></h5>
              <p>Hecho para que sea rápido y fácil</p>
              <hr>
              <div class="text-left flow">
                <?php
                $data = $hostings[$i]['datos_hosting'];
                $plan = $hostings[$i]['cod_hosting'];
                $point = explode(".", $data);
                $info = explode(",", $point[1]);
                for ($j=0; $j < $point[0]; $j++) { ?>
                  <i class="fas fa-check green"></i><span class="out mayus"><?php echo($info[$j]); ?></span><br>
                <?php } ?>
              </div>
              <br>
              <hr>
              <h4 class="top">$ <?php echo($hostings[$i]['valor_mensual']); ?>/mes</h4>
              <button class="btn btn-success" onclick="location.href='HostingPaymentClient?plan=<?php echo($plan); ?>'">Comprar este paquete</button>
            </div>
          </div>
        </div>
      </td>
    <?php } ?>
    </tr>
  </table>
  <div class="text-center ver">
    <h2>Ver otras opciones de paquetes</h2>
    <hr>
      <?php 
      if ($tipo == 'Platino') { ?>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3">
            <button class="btn plata" onclick="location.href='InfoHostingsClient?type=Plata'">Plata</button>
          </div>
          <div class="col-3">
            <button class="btn oro" onclick="location.href='InfoHostingsClient?type=Oro'">Oro</button>
          </div>
          <div class="col-3"></div>
        </div>
      <?php } else if ($tipo == 'Plata') { ?>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3">
            <button class="btn platino" onclick="location.href='InfoHostingsClient?type=Platino'">Platino</button>
          </div>
          <div class="col-3">
            <button class="btn oro" onclick="location.href='InfoHostingsClient?type=Oro'">Oro</button>
          </div>
          <div class="col-3"></div>
        </div>
      <?php } else { ?>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3">
            <button class="btn platino" onclick="location.href='InfoHostingsClient?type=Platino'">Platino</button>
          </div>
          <div class="col-3">
            <button class="btn plata" onclick="location.href='InfoHostingsClient?type=Plata'">Plata</button>
          </div>
          <div class="col-3"></div>
        </div>
      <?php } ?>
  </div>
</div>
<?php } ?>
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
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>