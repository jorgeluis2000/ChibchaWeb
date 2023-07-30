<?php
session_start(); 
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/HostingClienteDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/DominiosDAO.class.php');

if($_SESSION["loggedIn"] == false) {
  header("location: ../../principal/Home");
}
$userDAO = new UsuarioDAO();
$usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);
$codigo = $usuario->getCodigoUsuario();

$name = $usuario->getNombreUsuario();
$ape = $usuario->getApellidoUsuario();

$user = $name.' '.$ape;

$correo = $usuario->getCorreoUsuario();

if (isset($_POST['pay'])) {
    $date = $_POST['a2'];
    $fPago;
    if ($_POST['a5'] == 'cash') {
      $fPago = "Efectivo";
    } else {
      $fPago = $_POST['a5'];
    }
    $client = $_GET['client'];
    $tiempo = $_GET['plazo'];
    $time;
    if ($tiempo == 0) {
      $time = 'Mensual';
    } elseif ($tiempo == 1) {
      $time = 'Trimestral';
    } elseif ($tiempo == 2) {
      $time = 'Semestral';
    } else {
      $time = 'Anual';
    }
  if (isset($_GET['name'])) {
    $distri = $_GET['dist'];
    $listaDis = $userDAO->getDistributor();
    $user = $listaDis[$distri]['cod_usuario'];
    $nombre = $_GET['name'];
    $total = $_POST['a11'];
    $dominiosDAO = new DominiosDAO();
    $dominiosDAO->saveDomain($client, $user, $nombre, $date, $total, $time, $fPago);
  } else {
    $host = $_GET['plan'];
    $hostingClienteDAO = new HostingClienteDAO();
    $hostingClienteDAO->savePurchase($client, $fPago, $host, $time, $date);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ChibchaWeb | Compra realizada</title>
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
<div class="container top11">
  <div class="row" style="margin-top:20px">
    <div class="col-2"></div>
    <div class="col-8 text-center">
      <h4> Respuesta de la Transacción </h4>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Referencia</td>
              <td id="1"></td>
            </tr>
            <tr>
              <td class="bold">Fecha</td>
              <td id="2"></td>
            </tr>
            <tr>
              <td>Respuesta</td>
              <td id="3"></td>
            </tr>
            <tr>
              <td>Motivo</td>
              <td id="4"></td>
            </tr>
            <tr>
              <td>Forma de pago:</td>
              <td id="5"></td>
            </tr>
            <tr>
              <td class="bold">Banco</td>
              <td id="6">
              </tr>
              <tr>
                <td class="bold">Número de tarjeta</td>
                <td id="7">
                </tr>
                <tr>
                  <td class="bold">Cuotas</td>
                  <td id="8">
                  </tr>
                  <tr>
                    <td class="bold">Recibo</td>
                    <td id="9"></td>
                  </tr>
                  <tr>
                    <td class="bold">Total</td>
                    <td id="10">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <footer>
          <div class="container">
            <div class="row">
              <div class="col-2"></div>
              <div class="col-8">
                <img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/pagos_procesados_por_epayco_260px.png" style="margin-top:10px; float:left"> <img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/credibancologo.png"
                height="40px" style="margin-top:10px; float:right">
              </div>
            </div>
          </div>
        </footer>
        <div class="row">
          <form method="POST" class="col-12 top3 text-center">
            <?php for ($i=1; $i < 12; $i++) { ?>
              <input type="hidden" name="<?php echo('a'.$i); ?>" id="<?php echo('a'.$i); ?>">
            <?php } ?>
            <button type="submit" name="pay" class="col-8 btn btn-danger">Finalizar proceso de pago</button>
          </form>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
      function getQueryParam(param) {
        location.search.substr(1)
        .split("&")
      .some(function(item) { // returns first occurence and stops
        return item.split("=")[0] == param && (param = item.split("=")[1])
      })
      return param
    }
    $(document).ready(function() {
    //llave publica del comercio
    //Referencia de payco que viene por url
    var ref_payco = getQueryParam('ref_payco');
    //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
    var urlapp = "https://secure.epayco.co/validation/v1/reference/" + ref_payco;
    $.get(urlapp, function(response) {
      if (response.success) {
        if (response.data.x_cod_response == 1) {
          //Codigo personalizado
          alert("Transaccion Aprobada");
          console.log('transacción aceptada');
        }
        //Transaccion Rechazada
        if (response.data.x_cod_response == 2) {
          console.log('transacción rechazada');
        }
        //Transaccion Pendiente
        if (response.data.x_cod_response == 3) {
          console.log('transacción pendiente');
        }
        //Transaccion Fallida
        if (response.data.x_cod_response == 4) {
          console.log('transacción fallida');
        }
        $('#1').text(response.data.x_id_invoice);
        $('#2').text(response.data.x_transaction_date);
        $('#3').text(response.data.x_response);
        $('#4').text(response.data.x_response_reason_text);
        $('#5').text(response.data.x_type_payment);
        $('#6').text(response.data.x_bank_name);
        $('#7').text(response.data.x_cardnumber);
        $('#8').text(response.data.x_quotas);
        $('#9').text(response.data.x_transaction_id);
        $('#10').text(response.data.x_amount + ' ' + response.data.x_currency_code); 

        $('#a1').val(response.data.x_id_invoice);
        $('#a2').val(response.data.x_transaction_date);
        $('#a3').val(response.data.x_response);
        $('#a4').val(response.data.x_response_reason_text);
        $('#a5').val(response.data.x_type_payment);
        $('#a6').val(response.data.x_bank_name);
        $('#a7').val(response.data.x_cardnumber);
        $('#a8').val(response.data.x_quotas);
        $('#a9').val(response.data.x_transaction_id);
        $('#a10').val(response.data.x_amount + ' ' + response.data.x_currency_code);
        $('#a11').val(response.data.x_amount);
      } else {
        alert("Error consultando la información");
      }
    });
  });
</script>