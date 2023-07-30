<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/database.class.php');
session_start();
if (isset($_SESSION["loggedIn"])) {
    if ($_SESSION["loggedIn"] == true) {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
        $userDAO = new UsuarioDAO();
        $usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);
        if ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 2) {
            header("location: ../modulos/Client/ProfileClient");
        }elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 1) {
            header("location: ../modulos/Admin/AdminHome");
        }elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 3) {
            header("location: ../modulos/Distributor/ProfileDistributor");
        }elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 4) {
            header("location: ../modulos/Employee/ProfileEmployee");
        }
    }
}
$db = new Database();
$db->connect();
$count = "SELECT * FROM CALIFICACION ORDER BY cod_calificacion DESC";
$db->doQuery($count, SELECT_QUERY);
$num = $db->results[0];
$cant = $num['cod_calificacion'];
$suma = 0;
$total = "SELECT * from CALIFICACION";
$db->doQuery($total, SELECT_QUERY);
for ($i=0; $i < $cant; $i++) { 
    $data = $db->results[$i];
    $nums = $data['val_calificacion'];
    $suma+=$nums;
}
$avg = round($suma/$cant,2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChibchaWeb | Home</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>
    <link rel="stylesheet" href="../../Data/css/main.css"/>
    <link rel="stylesheet" href="../../Data/js/execute.js"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body onLoad="iniciar()">
    <header>
        <div class="textos">
            <h1 class="titulo">Chibcha Web</h1>
            <p><em class="subtitulo">Los mejores servicios con la mejor calidad</em></p>
            <a href="Register" class="boton">Regístrate</a>
            <a href="Login" class="boton">Inicia Sesión</a>
        </div>
        <div class="sesgoabajo"></div>
    </header>
    <main>
        <section class="acerca-de">
            <div class="contenedor">
                <h2 class="sobre-nosotros">Sobre nosotros</h2>
                <h3 class="slogan"><em>¿ De qué se trata Chibcha Web ?</em></h3>
                <p class="parrafo">Somos una empresa de hospedaje de páginas Web ubicada en Sugamuxi. Nuestros
                    clientes están localizados en Colombia y países aledaños y en próximos meses contaremos con 
                    clientes de África. Actualmente hospedamos unos cuantos miles de sitiosWeb y ofrecemos tres 
                    tipos de paquetes de “hosting” sobre plataformas Windows y Unix: Chibcha-Platino, 
                Chibcha-Plata y Chibcha-Oro.</p>
                <p class="parrafo">Tenemos variedad en nuestros planes de pago: Mensual, trimestral, semestral 
                    o anual y del mismo modo flexibilidad en los métodos de pago. No fungimos como registrador 
                    de dominio sino que trabajamos con varios registradores de dominio del mundo para registrar 
                    nuevos dominios o transferir dominios existentes. Sin embargo, ofrecemos este servicio
                adicional para clientes que lo soliciten.</p>
                <a href="infoGeneral#1" class="boton">Misión</a>
                <a href="infoGeneral#2" class="boton">Visión</a>
                <a href="infoGeneral#3" class="boton">Política</a>
            </div>
        </section>
        <section class="galeria">
            <div class="sesgoarriba"></div>
            <div class="img1 none">
                <img src="../../Data/imgs/tip1.png" alt="">
                <h4 class="txt1"><b>Múltiples herramientas para tu sitio</b></h4>
            </div>
            <div class="img2">
                <img src="../../Data/imgs/tip2.png" alt="">
                <h4 class="txt2"><b>Velocidad y gran rendimiento</b></h4>
            </div>
            <div class="img5">
                <div class="encima">
                    <h2>COMPLETA</h2><p></p>
                    <div></div>
                    <h2>VERSATILIDAD</h2>
                </div>
            </div>
            <div class="img3">
                <img src="../../Data/imgs/tip3.png" alt="">
                <h4 class="txt3"><b>Conectividad y alcance continuo</b></h4>
            </div>
            <div class="img4 none">
                <img src="../../Data/imgs/tip4.png" alt="">
                <h4 class="txt4"><b>Precios adecuados a tus necesidades</b></h4>
            </div>
            <div class="sesgoabajo"></div>
        </section>
        <section>
            <div class="container con">
                <div class="row justify-content-between">
                    <div class="col-3 text-center">
                        <img src="../../Data/imgs/round1.webp" onclick="location.href='Register'">
                        <h3>Hosting</h3>
                        <p>Los mejores planes de hosting para hospedar tus sitios</p>
                    </div>
                    <div class="col-3 text-center">
                        <img src="../../Data/imgs/round2.webp" onclick="location.href='Register'">
                        <h3>Servicio</h3>
                        <p>Brindamos el mejor apoyo para darte las mejores soluciones</p>
                    </div>
                    <div class="col-3 text-center">
                        <img src="../../Data/imgs/round3.webp" onclick="location.href='Register'">
                        <h3>Dominios</h3>
                        <p>Adquiere el dominio que mejor se acomode a ti</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="fondo">
            <div class="sesgoarriba"></div>
            <div class="contenedor">
                <h2 class="titulo-patrocinadores">Clientes aliados</h2>
                <h3 class="subtitulo-patrocinadores">Conoce algunos de nuestros patrocinadores</h3>
                <div class="clientes">
                    <div class="cliente">
                        <img src="../../Data/imgs/Hostinger.png" alt="" onclick="location.href=''">
                    </div>
                    <div class="cliente">
                        <img src="../../Data/imgs/GoDaddy.png" alt="" onclick="location.href=''">
                    </div>
                    <div class="cliente">
                        <img src="../../Data/imgs/Ionos.png" alt="" onclick="location.href=''">
                    </div>
                </div>
                <h3 class="subtitulo-patrocinadores especial"><em><a href="Request">¿ Te gustaría trabajar con nosotros ?</a></em></h3>
            </div>
            <div class="sesgoabajo-unico"></div>
        </section>
    </main>
    <div class="foot">
        <div class="contenedor">
            <h2 class="titulo-footer">Contáctanos</h2>
            <h3 class="subtitulo-footer">Lo apreciariamos mucho</h3>
            <div>
                <form action="../../Controller/mail.php" method="POST">
                    <input type="text" name="nom" id="" placeholder="Nombre" required>
                    <input type="email" name="cor" id="" placeholder="Email" required>
                    <textarea name="msm" id="" cols="30" rows="10" required placeholder="Ingrese su mensaje..."></textarea>
                    <input type="submit" name="mail" value="Enviar">
                </form>
            </div>
        </div>
    </div>
    <div class="back">
        <div class="cover">
            <div class="up-foot">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 txt-left">
                            <i class="fas fa-at"></i><span onclick="location.href='infoGeneral#I'">Nuestro Correo</span>
                            <p>chweb.info@gmail.com</p>
                            <i class="fab fa-whatsapp"></i><span onclick="location.href='infoGeneral#I'">Nuestro Teléfono</span>
                            <p>3201845382</p>
                            <p class="top">6269520</p>
                            <i class="fas fa-map-marker-alt"></i><span onclick="location.href='infoGeneral#mapa'">Nuestras Sedes</span>
                            <p>Calle 160 #11-43</p>
                            <p class="top">Cra 29A #120-85</p>
                        </div>
                        <div class="col-1 line-left"></div>
                        <div class="col-4">
                            <div class="top-2">
                                <div class="row container-social">
                                    <div class="button">Búscanos en nuestras redes</div>
                                    <div class="social twitter"><a href="twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></div>
                                    <div class="social facebook"><a href="facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></div>
                                    <div class="social google"><a href="google.com" target="_blank"><i class="fab fa-google-plus-g"></i></a></div>
                                    <div class="social youtube"><a href="youtube.com" target="_blank"><i class="fab fa-youtube"></i></a></div>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                <defs>
                                    <filter id="goo">
                                        <feGaussianBlur in="SourceGraphic" stdDeviation="8" result="blur" />
                                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                                        <feBlend in="SourceGraphic" in2="goo" />
                                    </filter>
                                </defs>
                            </svg>
                            <div style="padding: 22px;">
                                <div class="row box">
                                    <div class="evalua">
                                        <p>Evalúa tu experiencia en la página, Califícanos.</p>
                                        <p class="top"><b>Promedio de calificaciones (<?php echo($avg); ?>)</b></p>
                                    </div>
                                    <div class="ec-stars-wrapper">
                                        <a href="#" title="Votar con 1 estrella1" onclick="location.href='../../Controller/votes?valor=1';"><i class=" fas fa-star"></i></a>
                                        <a href="#" title="Votar con 2 estrellas" onclick="location.href='../../Controller/votes?valor=2';"><i class=" fas fa-star"></i></a>
                                        <a href="#" title="Votar con 3 estrellas" onclick="location.href='../../Controller/votes?valor=3';"><i class=" fas fa-star"></i></a>
                                        <a href="#" title="Votar con 4 estrellas" onclick="location.href='../../Controller/votes?valor=4';"><i class=" fas fa-star"></i></a>
                                        <a href="#" title="Votar con 5 estrellas" onclick="location.href='../../Controller/votes?valor=5';"><i class=" fas fa-star"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 line-right"></div>
                        <div class="col-3 txt-right">
                            <span onclick="location.href='Login'">Nuestros Paquetes</span><i class="fas fa-mail-bulk"></i>
                            <p>Plan Platino</p>
                            <p class="top">Plan Plata</p>
                            <p class="top">Plan Oro</p>
                            <span onclick="location.href='infoGeneral'">Sobre Nosotros</span><i class="fas fa-info-circle"></i>
                            <p>Misión</p>
                            <p class="top">Visión</p>
                            <p class="top">Política</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="last"></div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(".button").click(function(){
      $(".social.twitter").toggleClass("clicked");
      $(".social.facebook").toggleClass("clicked");
      $(".social.google").toggleClass("clicked");
      $(".social.youtube").toggleClass("clicked");
  })
</script>
<!--
https://www.creativosonline.org/blog/botones-css-gratuitos.html
http://www.alessioatzeni.com/blog/css3-hover-effects/
-->