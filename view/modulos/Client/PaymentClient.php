<?php

$rta;
$url;
$info;

$plazo  = $_GET['plazo'];
$valT = $_GET['total'];
$client = $_GET['client'];

if (isset($_GET['nom'])) {
  $nombre = $_GET['nom'];
  $distri = $_GET['dist'];

  $rta = "http://localhost:80/ChibchaWeb/view/modulos/Client/ResponseClient.php?plazo=$plazo&name=$nombre&client=$client&dist=$distri";
  $info = "Dominio - $nombre";
  $url = "DomainsClient";

} else {
  $valU = $_GET['valU'];
  $fecha = $_GET['fecha'];
  $plan = $_GET['host'];
  $tipo = $_GET['type'];

  $rta = "http://localhost:80/ChibchaWeb/view/modulos/Client/ResponseClient.php?plazo=$plazo&client=$client&plan=$plan";
  $info = "Hosting - plan $tipo";
  $url = "HostingClient";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>ChibchaWeb | Proceso de pago</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:900&display=swap" rel="stylesheet">
</head>
<body>
<style type="text/css">
html {
  background: url(../../../Data/imgs/buy.jpg);
  background-size: cover;
  background-repeat: no-repeat;
}
button {
  border: none;
  background: #888;
  color: #FFF;
  padding: 10px;
  border-radius: 15px;
  width: 150px;
  margin-top: 50px;
  cursor: pointer;
  box-shadow: 0 0 15px 1px rgba(0,0,0,.5);
  font-family: 'Raleway', sans-serif;
}
</style>
<center><button onclick="location.href='$url'">VOLVER</button></center>
  <div hidden="true">
    <script
    src="https://checkout.epayco.co/checkout.js"
    class="epayco-button"
    data-epayco-autoclick="true"
    data-epayco-key="491d6a0b6e992cf924edd8d3d088aff1"
    data-epayco-amount="<?php echo($valT); ?>"
    data-epayco-name="<?php echo($info); ?>"
    data-epayco-description="<?php echo($info); ?>"
    data-epayco-currency="USD"
    data-epayco-country="CO"
    data-epayco-test="false"
    data-epayco-external="false"
    data-epayco-response="<?php echo($rta); ?>"
    data-epayco-confirmation="<?php echo($rta); ?>">
  </script>
</div>
</body>
</html>