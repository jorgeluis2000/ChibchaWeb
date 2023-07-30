<?php
session_start(); 
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/ClienteDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/SitioWebDAO.class.php');
if($_SESSION["loggedIn"] == false) {
  header("location: ../../principal/Home");
}
$userDAO = new UsuarioDAO();
$usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);

$name = $usuario->getNombreUsuario();
$ape = $usuario->getApellidoUsuario();
$img = $usuario->getImagenUsuario();

$user = $name.' '.$ape;

$correo = $usuario->getCorreoUsuario();
$telefono = $usuario->getTelefonoUsuario();
$documento = $usuario->getDocumentoUsuario();
$clave = $usuario->getContraseniaUsuario();
$codigo = $usuario->getCodigoUsuario();

$clienteDao = new ClienteDAO();
$cliente = $clienteDao->getClienteLogin($codigo);

$pais = $cliente->getPais();
$fecha = $cliente->getFecha();

$sitioDAO = new SitioWebDAO();
$codSitio = $cliente->getSitio();

$sitio = $sitioDAO->getSitioWeb($codSitio);

$nomSite = $sitio->getNombreSitioWeb();
$logoSite = $sitio->getLogo();
$descSite = $sitio->getDescripcionSitioWeb();
$tipoSite = $sitio->getTipoSitioWeb();

if (isset($_POST["cambioFoto"])) {

  $val_img = $_FILES['imgUser']['name'];
  $src_img = $_FILES['imgUser']['tmp_name'];
  $destino = $_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Data/Profiles/'.$name.$ape.'_'.$val_img;
  $nuevaRuta = 'Data/Profiles/'.$name.$ape.'_'.$val_img;
  copy($src_img, $destino);

  $userDAO->uploadPhoto($codigo, $nuevaRuta);
}

if (isset($_POST["editProfile"])) {

  $nmEdit = $_POST['nmEdit'];
  $apEdit = $_POST['apEdit'];
  $dcEdit = $_POST['dcEdit'];
  $coEdit = $_POST['coEdit'];
  $teEdit = $_POST['teEdit'];
  $paEdit = $_POST['paEdit'];
  $psEdit = $_POST['psEdit'];

  $userDAO->uploadUser($codigo, $nmEdit, $apEdit, $dcEdit, $coEdit, $teEdit, $paEdit, $psEdit);
}

if (isset($_POST["photoSite"])) {

  $val_img = $_FILES['imgSite']['name'];
  $src_img = $_FILES['imgSite']['tmp_name'];
  $destino = $_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Data/Logos/'.$nomSite.'_'.$val_img;
  $nuevaRuta = 'Data/Logos/'.$nomSite.'_'.$val_img;
  copy($src_img, $destino);

  $sitioDAO->uploadPhoto($codSitio, $nuevaRuta);
}

if (isset($_POST["editSite"])) {

  $nmSite = $_POST['nmSite'];
  $tpSite = $_POST['tpSite'];
  $dsSite = $_POST['dsSite'];

  $sitioDAO->uploadSite($codSitio, $nmSite, $tpSite, $dsSite);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChibchaWeb | Perfil</title>
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
          <input class="form-control large" type="search" placeholder="Busca usuarios o sitios ..." aria-label="Search">
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
  <div class="row top">
    <div class="col-4">
      <img src="<?php echo('../../../'.$img) ?>" class="img_profile">
    </div>
    <div class="col-8">
      <div class="inicial col-10" id="0">
        <p>¡Personaliza tu perfil como quieras!</p>
          <hr>
        <span>Revisa toda tu información y editala cuando necesites.</span>
      </div>
      <div class="pad2 top div_hid sizeTxt col-10" id="1">
        <div class="row">
          <div class="col-1">
            <div class="color2"></div>
          </div>
          <div class="col-3">
            <hr class="hr2">
            <b>Nombre:</b>
            <div class="top8">
              <b>Apellido:</b>
            </div>
            <div class="top8">
              <b>Documento:</b>
            </div>
            <div class="top8">
              <b>Correo:</b>
            </div>
            <div class="top8">
              <b>Teléfono:</b>
            </div>
            <div class="top8">
              <b>País:</b>
            </div>
            <div class="top5">
              <b>Nombre del sitio:</b>
            </div>
            <div class="top8">
              <b>Fecha de ingreso:</b>
            </div>
          </div>
          <div class="col-7 top1">
            <input class="in" value="<?php echo($name); ?>" disabled>
            <input class="in" value="<?php echo($ape); ?>" disabled>
            <input class="in" value="<?php echo($documento); ?>" disabled>
            <input class="in" value="<?php echo($correo); ?>" disabled>
            <input class="in" value="<?php echo($telefono); ?>" disabled>
            <input class="in" value="<?php echo($cliente->getPais()); ?>" disabled>
            <input class="in top4" value="<?php echo($nomSite); ?>" disabled>
            <input class="in" value="<?php echo($fecha); ?>" disabled>
          </div>
        </div>
      </div>
      <div class="pad2 top div_hid sizeTxt col-10" id="2">
        <form action="" method="post">
          <div class="row">
            <div class="col-1">
              <div class="color2"></div>
            </div>
            <div class="col-3">
              <b>Nombre:</b>
              <div class="top8">
                <b>Apellido:</b>
              </div>
              <div class="top8">
                <b>Documento:</b>
              </div>
              <div class="top8">
                <b>Correo:</b>
              </div>
              <div class="top8">
                <b>Teléfono:</b>
              </div>
              <div class="top8">
                <b>País:</b>
              </div>
              <div class="top8">
                <b>Contraseña:</b>
              </div>
              <div>
                <button type="submit" name="editProfile" class="btn btn-up1"><i class="fas fa-edit out"></i><span class="txtEdit">&nbsp | &nbsp Editar</span></button>
              </div>
            </div>
            <div class="col-7 top1">
              <input class="in" name="nmEdit" value="<?php echo($name); ?>" required>
              <input class="in" name="apEdit" value="<?php echo($ape); ?>" required>
              <input class="in" name="dcEdit" value="<?php echo($documento); ?>" required>
              <input class="in" name="coEdit" value="<?php echo($correo); ?>" required>
              <input class="in" name="teEdit" value="<?php echo($telefono); ?>" required>
              <input class="in" name="paEdit" value="<?php echo($cliente->getPais()); ?>" required>
              <div class="row">
                <div class="col-10">
                  <input type="password" class="in" name="psEdit" value="<?php echo($clave); ?>" id="password" required>
                </div>
                <div class="col-2">
                  <i class="fas fa-eye eye" onclick="show();"></i>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="pad2 top div_hid col-10" id="3">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-1">
              <div class="color2"></div>
            </div>
            <div class="col-10 infoImg">
              <div class="row">
                <div class="col-12">
                  <span>Siéntete libre de añadir tu foto de perfil en Chibcha Web.</span><br>
                  <span>¡ Selecciona la que te guste mas !</span>
                </div>
              </div>
              <div class="dropzone" id="dropzone">
                <div class="row">
                  <div class="col-12 uploadDiv">
                    <span>HOLA</span>
                  </div>
                </div>
                <div class="row hide">
                  <div class="col-1"></div>
                  <div class="col-4" id="drop_a">
                    <span>Busca un archivo</span>
                  </div>
                  <div class="col-2 out" id="drop_b">
                    <div id="div_file" class="top3">
                      <p id="texto_add"><i class="fas fa-upload"></i></p>
                      <input type="file" name="imgUser" id="btn_add" required>
                    </div>
                  </div>
                  <div class="col-4" id="drop_c">
                    <span>O arrástralo acá</span>
                  </div>
                  <div class="col-1"></div>
                </div>
              </div>
              <div class="row">
                <div>
                  <button type="submit" name="cambioFoto" id="Photo1" class="btn btn-up1 left1"><i class="fas fa-edit out"></i><span class="txtEdit">&nbsp | &nbsp Editar</span></button>
                  <button type="submit" onclick="location.href='MyProfileClient'" id="Photo2" class="btn btn-up1 left1 div_hid"><i class="fas fa-edit out"></i><span class="txtEdit">&nbsp | &nbsp Editar</span></button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="pad2 top div_hid sizeTxt col-10" id="4">
        <div class="row">
          <div class="col-1">
            <div class="color2"></div>
          </div>
          <div class="col-10">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-4">
                  <img class="userImg" src="<?php echo('../../../'.$logoSite); ?>">
                </div>
                <div class="col-8 top8">
                  <span><b>Nombre del sitio:</b></span>
                  <div class="top2">
                    <input class="inp top2" name="nmSite" value="<?php echo($nomSite); ?>" required>
                  </div>
                  <p class="top4"><b>Tipo de sitio:</b></p>
                  <div class="top2">
                    <input class="inp top6" name="tpSite" value="<?php echo($tipoSite); ?>" required>
                  </div>
                  <div class="area">
                    <textarea class="area" name="dsSite" value="<?php echo($descSite); ?>" required><?php echo($descSite); ?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-1">
                  <div id="div_file" class="top12">
                    <p id="texto_add"><i class="fas fa-upload"></i></p>
                    <input type="file" name="imgSite" id="btn_add">
                  </div>
                </div>
                <div class="col-11"></div>
                <div class="col-4">
                  <button type="submit" name="photoSite" class="btn btn-up2"><i class="fas fa-image"></i><span class="txtEdit">&nbsp | &nbsp Nueva foto</span></button>
                </div>
                <div class="col-8"></div>
                <div class="col-4">
                  <button type="submit" name="editSite" class="btn btn-up2"><i class="fas fa-edit"></i><span class="txtEdit">&nbsp | &nbsp Editar perfil</span></button>
                </div>
                <div class="col-8"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> 
  <div class="row">
    <div class="col-12">
      <nav class="navbar nav2 pad0">
        <div class="pad">
          <b class="txt_back">Opciones</b>
        </div>
        <i class="fas fa-bars fa-1x drop" data-toggle="collapse" data-target="#navbarSupportedContent1"
          aria-controls="navbarSupportedContent1"></i>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
          <ul class="navbar-nav">
            <li class="nav-item col_a" id="col1" onclick="appear(1);">
              <i class="fas fa-info-circle icon_a"></i><span>Información básica</span>
            </li>
            <li class="nav-item col_a" id="col2" onclick="appear(2);">
              <i class="fas fa-edit icon_a"></i><span>Editar perfil</span>
            </li>
            <li class="nav-item col_a" id="col3" onclick="appear(3);">
              <i class="fas fa-image icon_a"></i><span>Imagen de perfil</span>
            </li>
            <li class="nav-item col_a" id="col4" onclick="appear(4);">
              <i class="fas fa-desktop icon_a"></i><span>Sitio web</span>
            </li>
          </ul>
        </div>
      </nav>
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
<script type="text/javascript">
  function DragDrop(file) {
    xhr = new XMLHttpRequest();
    xhr.open('post', '../../../Controller/photo?us=1', true);
    xhr.setRequestHeader('Content-Type', 'multipart/form-data');
    xhr.setRequestHeader('X-File-Name', file.fileName);
    xhr.setRequestHeader('X-File-Size', file.fileSize);
    xhr.setRequestHeader('X-File-Type', file.fileType);
    xhr.send(file);
  }
  function appear(code){
    document.getElementById("0").style.display = "none";
    for (var i = 1; i < 5; i++) {
      document.getElementById(i).style.display = "none";
      document.getElementById("col"+i).style.background = "#566573";
      document.getElementById("col"+i).style.color = "#F2F3F4";
    }
    document.getElementById(code).style.transition = 0.5;
    document.getElementById(code).style.display = "block";
    document.getElementById("col"+code).style.background = "#2E4053";
    document.getElementById("col"+code).style.color = "#FFF";
  }
  function show(){
    var tipo = document.getElementById("password");
    if(tipo.type == "password"){
      tipo.type = "text";
    } else {
      tipo.type = "password";
    }
  }
  (function() {
    var dropzone = document.getElementById("dropzone");
    dropzone.ondrop = function(event) {
      event.preventDefault();
      this.className = "dropzone";
      var files = event.dataTransfer.files;
      var file = files[0];
      var name = file.name;
      var size = file.size+" bytes";
      document.querySelector(".hide").style.display = "none";
      document.querySelector(".uploadDiv").style.display = "block";
      document.querySelector(".uploadDiv span").innerHTML = name+" / "+size;
      document.getElementById("Photo1").style.display = "none";
      document.getElementById("Photo2").style.display = "block";

      DragDrop(file);
    }
    dropzone.ondragover = function() {
      this.className = "dropzone dragover";
      document.getElementById("drop_a").style.color = "black";
      document.getElementById("drop_c").style.color = "black";
      document.getElementById("div_file").style.background = "black";
      return false;
    }
    dropzone.ondragleave = function() {
      this.className = "dropzone";
      document.getElementById("drop_a").style.color = "#999";
      document.getElementById("drop_c").style.color = "#999";
      document.getElementById("div_file").style.background = "#999";
      return false;
    }
  }());
</script>