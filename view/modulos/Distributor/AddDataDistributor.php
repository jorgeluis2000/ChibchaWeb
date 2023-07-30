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
$codigo = $usuario->getCodigoUsuario();
$name = $usuario->getNombreUsuario();
$ape = $usuario->getApellidoUsuario();

$user = $name;

$correo = $usuario->getCorreoUsuario();

if(isset($_POST['guardar'])) {
  $preA = $_POST['pre1'];
  $preB = $_POST['pre2'];
  $preC = $_POST['pre3'];
  $canA = $_POST['inp1'];
  $canB = $_POST['inp2'];
  $canC = $_POST['inp3'];
  $arrA = "";
  $arrB = "";
  $arrC = "";
  for($i = 0; $i < $canA; $i++){
    $arrA = $arrA.($_POST["1_".($i+1)].",");
  }
  for($i = 0; $i < $canB; $i++){
    $arrB = $arrB.($_POST["2_".($i+1)].",");
  }
  for($i = 0; $i < $canC; $i++){
    $arrC = $arrC.($_POST["3_".($i+1)].",");
  }
  $nomP = $_POST['nomT'];
  $banP = $_POST['banT'];
  $numP = $_POST['numT'];
  $finalA = $canA.'.'.$arrA;
  $finalB = $canB.'.'.$arrB;
  $finalC = $canC.'.'.$arrC;
  $hostDAO->saveHosting($codigo, $preA, $preB, $preC, $finalA, $finalB, $finalC, $nomP, $banP, $numP);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ChibchaWeb | Nuevos paquetes</title>
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
    <img class="navbar-brand logoNav" src="../../../Data/imgs/ChibchaWeb2.png" onclick="location.href='ProfileDistributor'">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="line"></div> 
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="ProfileDistributor"><span class="col">Inicio</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="HostingDistributor"><span class="col">Hosting</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="DomainsDistributor"><span class="col">Dominios</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="BillingDistributor"><span class="col">Facturación</span></a>
        </li>
      </ul>
      <ul class="navbar-nav navbar-right">
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
            <div class="txt_perfil" onclick="location.href='MyProfileDistributor'">
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
          <li><a href="#tab1"><button class="cir"><span>1</span></button><span class="tab-text">Plan Platino</span></a></li>
          <li><a href="#tab2"><button class="cir"><span>2</span></button><span class="tab-text">Plan Plata</span></a></li>
          <li><a href="#tab3"><button class="cir"><span>3</span></button><span class="tab-text">Plan Oro</span></a></li>
          <li><a href="#tab4"><span class="far fa-credit-card top8"></span><span class="tab-text">Tarjeta</span></a></li>
        </ul>
        <form method="POST">  
          <div class="formulario dat">
            <div class="secciones">
              <article id="tab1">
                <span>Valor mensual de este paquete (US)</span><input type="text" class="inp1" name="pre1"><br>
                <span>Cantidad de características del plan</span><input type="number" id="inp1" name="inp1"><button class="btn" id="btn1" onclick="add(1);">Agregar</button>
                <div class="row">
                  <div id="inf1" class="col-6 top3"><br></div>
                  <div class="col-6 text-center">
                  </div>
                </div>
              </article>
              <article id="tab2">
                <span>Valor mensual de este paquete (US)</span><input type="text" class="inp1" name="pre2"><br>
                <span>Cantidad de características del plan</span><input type="number" id="inp2" name="inp2"><button class="btn" id="btn2" onclick="add(2);">Agregar</button>
                <div class="row">
                  <div id="inf2" class="col-6 top3"><br></div>
                  <div class="col-6 text-center">
                  </div>
                </div>
              </article>
              <article id="tab3">
                <span>Valor mensual de este paquete (US)</span><input type="text" class="inp1" name="pre3"><br>
                <span>Cantidad de características del plan</span><input type="number" id="inp3" name="inp3"><button class="btn" id="btn3" onclick="add(3);">Agregar</button>
                <div class="row">
                  <div id="inf3" class="col-6 top3"><br></div>
                  <div class="col-6 text-center">
                  </div>
                </div>
              </article>
              <article id="tab4">
                <div class="row">
                  <div class="col-7">
                    <h3>Completa los datos para agregar tu tarjeta</h3>
                    <div class="top3">
                      <p>Nombre del propietario de la tarjeta</p>
                      <input type="text" class="inp2" name="nomT" required>
                    </div>
                    <div>
                      <p>Banco perteneciente a la tarjeta</p>
                      <input type="text" class="inp2" name="banT" required>
                    </div>
                    <div>
                      <p>Número de la tarjeta</p>
                      <input type="text" class="inp2" name="numT" required>
                    </div>
                  </div>
                  <div class="col-5 text-center">
                     <img src="../../../Data/imgs/check.png" class="imgCh">
                     <button type="submit" class="btn btn-success btCh" name="guardar">Agregar datos</button>
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
  function add(num) {
    document.getElementById("btn"+num).disabled="true";
    var cant = document.getElementById("inp"+num).value;
    for (var i = 0; i < cant; i++) {
      var nuevo = document.createElement("input");
      nuevo.style.width="200px";
      nuevo.style.marginTop="-15px";
      nuevo.required="true";
      nuevo.className="form-control";
      nuevo.placeholder="Descripción";
      nuevo.type="text";
      nuevo.name=num+"_"+(i+1);
      var br = document.createElement("br");
      document.getElementById("inf"+num).appendChild(nuevo);
      document.getElementById("inf"+num).appendChild(br);
    }
  }
</script>