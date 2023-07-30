<?php
session_start(); 
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/HostingDAO.class.php');

if($_SESSION["loggedIn"] == false) {
  header("location: ../../principal/Home");
}
$hostDAO = new HostingDAO();

$userDAO = new UsuarioDAO();
$usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);

$name = $usuario->getNombreUsuario();
$ape = $usuario->getApellidoUsuario();

$user = $name.' '.$ape;

$correo = $usuario->getCorreoUsuario();

$plan = $_GET['plan'];

$host = $hostDAO->getHosting($plan);
$tipo = $host->getTipo();
$datos = $host->getDatos();
$valor = $host->getValor();

$division = explode(".", $datos);
$cantidad = $division[0];
$data = explode(",", $division[1]);

$distribuidor = $userDAO->getUsuario($host->getDistribuidor());
$nom = $distribuidor->getNombreUsuario();
$mail = $distribuidor->getCorreoUsuario();
$photo = $distribuidor->getImagenUsuario();
$tel = $distribuidor->getTelefonoUsuario();
$doc = $distribuidor->getDocumentoUsuario();

if (isset($_POST['pay'])) {
  $plazo = $_POST['plazo'];
  $valT;
  if ($plazo == 0) {
    $valT = $valor*1;
  } elseif ($plazo == 1) {
    $valT = $valor*3;
  } elseif ($plazo == 2) {
    $valT = $valor*6;
  } else {
    $valT = $valor*12;
  }
  $a = date("d");
  $b = date("m");
  $c = date("y");
  $fecha = $a.'/'.$b.'/'.$c;
  $cliente = $usuario->getCodigoUsuario();

  header("location: PaymentClient?plazo=$plazo&total=$valT&fecha=$fecha&client=$cliente&valU=$valor&host=$plan&type=$tipo");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ChibchaWeb | Compra</title>
  <environment include="Development">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </environment>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="../../../Data/css/styles.css">
  <link rel="stylesheet" href="../../../Data/css/info.css">
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
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8 wrap">
        <ul class="tabs">
          <li><a href="#tab1"><span class="fas fa-mail-bulk"></span><span class="tab-text">Paquete</span></a></li>
          <li><a href="#tab2"><span class="far fa-file-alt"></span><span class="tab-text">Datos</span></a></li>
          <li><a href="#tab3"><span class="fas fa-user-tag"></span><span class="tab-text">Distribuidor</span></a></li>
          <li><a href="#tab4"><span class="fas fa-money-bill-wave"></span><span class="tab-text">Pago</span></a></li>
        </ul>
        <form method="POST">
          <div class="formulario">
            <div class="secciones">
              <article id="tab1">
                <h1>Has agregado el plan <?php echo($tipo); ?> </h1>
                <hr>
                <h3>Selecciona el plazo de tu plan</h3>
                <p>Obten una mayor flexibilidad para tu pago.</p>
                <hr>
                <div class="checkbox">
                  <?php 
                  $arr = ["Mensual","Trimestral","Semestral","Anual"];
                  for ($i=0; $i < 4; $i++) { ?> 
                    <input type="checkbox" id="<?php echo($i); ?>">
                    <label for="<?php echo($i); ?>" id="<?php echo($i); ?>" onclick="upload(<?php echo($i); ?>);"><?php echo("Plazo ".$arr[$i]); ?></label>
                  <?php } ?>
                  <input type="text" hidden="true" required name="plazo" id="plazo">
                </div>
                <img src="../../../Data/imgs/epayco.png" class="pay">
              </article>
              <article id="tab2">
                <h1>Detalles del paquete</h1>
                <hr>
                <h3>Verifica una vez más las características de tu plan</h3>
                <p>Si deseas hacer un cambio puedes volver atrás.</p>
                <hr>
                <div class="row">
                  <?php for ($i=0; $i < $cantidad; $i++) { ?>
                    <div class="col-3 top">
                      <i class="fas fa-check-circle"></i><span class="out"><?php echo($data[$i]); ?></span>
                    </div> 
                  <?php } ?>
                </div> 
              </article>
              <article id="tab3">
                <h1>Empresa asociada</h1>
                <hr>
                <h3>Conoce los detalles del distribuidor asociado</h3>
                <p>Información básica de la empresa.</p>
                <hr>
                <div class="row">
                  <div class="col-5">
                    <img src="<?php echo('../../../'.$photo); ?>" class="top">
                  </div>
                  <div class="col-1"></div>
                  <div class="col-3">
                    <div class="top3"> 
                      <b>Nombre:</b><br>
                    </div>
                    <div class="top">
                      <b>Nit:</b><br>
                    </div>
                    <div class="top">
                      <b>Correo:</b><br>
                    </div>
                    <div class="top">
                      <b>Teléfono:</b>
                    </div>
                  </div>
                  <div class="col-3 lefts">
                    <div class="top3">
                      <span><?php echo($nom); ?></span>
                    </div>
                    <div class="top">
                      <span><?php echo($doc); ?></span>
                    </div>
                    <div class="top">
                      <span><?php echo($mail); ?></span>
                    </div>
                    <div class="top">
                      <span><?php echo($tel); ?></span>
                    </div>
                  </div>
                </div>
              </article>
              <article id="tab4">
                <h1>Termina el proceso de pago</h1>
                <hr>
                <h3>El último paso para adquirir tu hosting</h3>
                <p>Escoge la mejor forma de pagar el paquete.</p>
                <hr>
                <div class="row">
                  <div class="col-3 top">
                    <span>Valor del paquete: </span>
                    <div class="top">
                      <span>Tiempo de pago:</span>
                    </div>
                    <div class="top">
                      <span>Valor total:</span>
                    </div>
                  </div>
                  <div class="col-6 top">
                    <input type="text" hidden="true" id="price" value="<?php echo($valor); ?>">
                    <b><?php echo('$ '.$valor.' /mes'); ?></b>
                    <div class="top">
                      <b id="val" class="mayus">No ha seleccionado un tiempo de pago</b>
                    </div>
                    <div class="top">
                      <b id="total" class="mayus">No ha seleccionado un tiempo de pago</b>
                    </div>
                  </div>
                  <div class="col-3">
                    <button class="btn btn-danger pago" name="pay">Pagar ahora</button>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </form>
      </div>
      <div class="col-2"></div>
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
  $('ul.tabs li a:first').addClass('active');
  $('.secciones article').hide();
  $('.secciones article:first').show();

  $('ul.tabs li a').click(function(){
    $('ul.tabs li a').removeClass('active');
    $(this).addClass('active');
    $('.secciones article').hide();

    var activeTab = $(this).attr('href');
    $(activeTab).show();
    return false;
  });

  function upload(num) {
    var val = document.getElementById("price").value;
    var total;
    var rta = "No ha seleccionado un tiempo de pago";
    for (var i = 0; i < 4; i++) {
      if (num == i) {
        for (var j = 0; j < 4; j++) {
          if (j != num) {
            document.getElementById("plazo").value = num;
            document.getElementById(j).checked = false;
            if (num == 0) {
              document.getElementById("val").innerHTML = "mensual";
              total = val*1;
            } else if (num == 1) {
              document.getElementById("val").innerHTML = "trimestral";
              total = val*3;
            } else if (num == 2) {
              document.getElementById("val").innerHTML = "semestral";
              total = val*6;
            } else {
              document.getElementById("val").innerHTML = "anual";
              total = val*12;
            }
            document.getElementById("total").innerHTML = "$ "+total.toFixed(2);
          }
          if(document.getElementById(i).checked == true) {
            document.getElementById("plazo").value = "";
            document.getElementById("val").innerHTML = rta;
            document.getElementById("total").innerHTML = rta;
          }
        }
      }
    }
  }
</script>