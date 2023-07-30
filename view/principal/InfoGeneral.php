<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
session_start();
if (isset($_SESSION["loggedIn"])) {
  if ($_SESSION["loggedIn"] == true) {
    $userDAO = new UsuarioDAO();
    $usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);

    $name = $usuario->getNombreUsuario();
    $ape = $usuario->getApellidoUsuario();

    $user = $name.' '.$ape;

    $correo = $usuario->getCorreoUsuario();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChibchaWeb | Información</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Data/css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:900&display=swap" rel="stylesheet">
  <script type="text/javascript" src="http://www.openlayers.org/api/OpenLayers.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"
type="text/javascript" charset="utf-8"></script>
</head>
<body onload="iniciar()">
<nav class="navbar navbar-expand-lg navbar-light nav" id="begin">
  <img class="navbar-brand logoNav" src="../../Data/imgs/ChibchaWeb2.png" onclick="location.href='ProfileClient'">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="line"></div> 
  <?php if (isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"] == true) { ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../modulos/Client/ProfileClient"><span class="col">Inicio</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../modulos/Client/HostingClient"><span class="col">Hosting</span></a>
      </li>
      <li class="nav-item">
      	<a class="nav-link" href="../modulos/Client/DomainsClient"><span class="col">Dominios</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../modulos/Client/BillingClient"><span class="col">Facturación</span></a>
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
          <button class="btn btn-danger color1" style="float: right;" onclick="location.href='../../Controller/closeSession'"><span>Cerrar Sesión</span><i class="fas fa-sign-out-alt out"></i></button>
        </div>
      </li> 
    </ul>
  </div>
  <?php } else { ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="Home"><span class="col">Home</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#M"><span class="col">Misión</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#V"><span class="col">Visión</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#P"><span class="col">Política</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#I"><span class="col">Contacto</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#mapa"><span class="col">Ubicación</span></a>
        </li>
      </ul>
      <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <button class="btn btn-success move3" onclick="location.href='Login'">Iniciar Sesión</button>
        </li>
        <li class="nav-item">
          <button class="btn btn-success move3" onclick="location.href='Register'">Registrarse</button>
        </li>
      </ul>
    </div>
  <?php } ?>
</nav>
<div class="container-fluid top">
  <div class="row">
    <div class="col-12">
      <div class="cover1" id="M">
        <div class="info">
          <div class="col-4">
              <h4>Misión</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="block"></div>
  <div class="row">
    <div class="col-12">
      <div class="cover2" id="V">
        <div class="info">
          <div class="col-4" style="float: right;">
              <h4>Visión</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="block"></div>
  <div class="row">
    <div class="col-12">
      <div class="cover3" id="P">
        <div class="info">
          <div class="col-4">
              <h4>Política</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row top11">
    <div class="col-4 middle"></div>
    <div class="col-4">
      <h1 class="font text-center" id="I">¡Escoge una manera para encontrarnos!</h1>
    </div>
    <div class="col-4 middle"></div>
  </div>
  <div class="row top3 data">
    <div class="col-6">
      <i class="fas fa-clock"></i><span class="out">Tiempo completo:</span>
      <div class="left3">
        <p>Ponte en contácto con nosotros a cualquier momento del día. Disfruta del mejor serivcio 24/7 y resolverémos todas tus dudas.</p>
      </div>
      <img src="../../Data/imgs/col.png"></i><span class="out">Servicio en Colombia:</span>
      <div class="left3">
        <p>Actualmente trabajamos 100% para el beneficio de todos los colombianos. Nuestra sede principal ubicada en Bogotá: Cra 18A #101 - 24</p>
      </div>
      <i class="fas fa-at blue"></i><span class="out">Correo electrónico:</span>
      <div class="left3">
        <p>chweb.info@gmail.com</p>
      </div>
      <i class="fab fa-whatsapp green"></i><span class="out">Número móvil:</span>
      <div class="left3">
        <p><b>+57:</b> 3102057439</p>
        <p><b>+57:</b> 3105508980</p>
      </div>
    </div>
    <div class="col-6">
      <div class="map">
        <div id="mapa" class="smallmap">
      </div>
    </div>
  </div>
</div>
<a href="#begin"><button class="btn up"><i class="fas fa-chevron-circle-up"></i></button></a>
</body>
</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
  //Habilito que se creen marcadores al dar clic en el mapa
  activarMarcadores=1;
</script>
<script type="text/javascript">
//Variables a utilizar
var mapa,capa;
function iniciar()
{
  //Creando el mapa
  mapa=new OpenLayers.Map("mapa");
  //Creando la capa - Agregando la capa
  mapa.addLayer(new OpenLayers.Layer.OSM());
  //Establenciendo donde visualizara el mapa, para esto debemos pasarle las coordenadas
  //de latitud y longitud, ademas del zoom, que indica que en este caso es 12
  epsg4326 = new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
  projectTo = mapa.getProjectionObject(); //The map projection (Spherical Mercator)

  var lonLat = new OpenLayers.LonLat(-74.051,4.687).transform(epsg4326, projectTo);
  var zoom = 14;
  mapa.setCenter (lonLat, zoom);

  var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
  var contenido = 
  "<div class='row justify-content-between' style='width: 200px; height: 200px;'>"+
  "<b>ACA ESTAMOS</b>"+
  "</div>";

  var feature = new OpenLayers.Feature.Vector(
    new OpenLayers.Geometry.Point(-74.051,4.687).transform(epsg4326, projectTo),
    {description:contenido} ,
    {externalGraphic: '../../Data/imgs/marker.png', graphicHeight: 30, graphicWidth: 25, graphicXOffset:-12, graphicYOffset:-35  }
    );    
    vectorLayer.addFeatures(feature);
    mapa.addLayer(vectorLayer);
    var controls = {
      selector: new OpenLayers.Control.SelectFeature(vectorLayer, { onSelect: createPopup, onUnselect: destroyPopup })
    };
    function createPopup(feature) {
      feature.popup = new OpenLayers.Popup.FramedCloud("pop",
          feature.geometry.getBounds().getCenterLonLat(),
          null,
          '<div class="markerContent">'+feature.attributes.description+'</div>',
          null,
          true,
          function() { controls['selector'].unselectAll(); }
      );
      //feature.popup.closeOnMove = true;
      map.addPopup(feature.popup);
    }
    function destroyPopup(feature) {
      feature.popup.destroy();
      feature.popup = null;
    }
    map.addControl(controls['selector']);
    controls['selector'].activate();
}
</script>
<script type="text/javascript">
$(function(){
  $('a[href*=#]').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
      && location.hostname == this.hostname) {
        var $target = $(this.hash);
        $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
        if ($target.length) {
          var targetOffset = $target.offset().top;
          $('html,body').animate({scrollTop: targetOffset}, 1000);
          return false;
        }
      }
   });
});
</script>