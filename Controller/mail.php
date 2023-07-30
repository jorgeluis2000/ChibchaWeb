<?php 

$nombre = $_POST['nom'];
$correo = $_POST['cor'];
$mensaje = $_POST['msm'];

require("../Data/mailer/class.phpmailer.php"); // Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
$mail = new PHPMailer();

$mailCh = 'chweb.info@gmail.com';

$mail->From     = $mailCh;
$mail->FromName = 'Información';
$mail->AddAddress($mailCh); // Dirección a la que llegaran los mensajes.

	// Aquí van los datos que apareceran en el correo que reciba
$img = "<img src='../../Data/imgs/ChibchaWeb.png' style='width: 100px; height: 100px; margin-top: 30px;'\n<br><p></p>".
      "<b>Correo de contácto: chweb.info@gmail.com</b> \n<br>".
      "<b>Número de contácto: 3102057439 - 3105508980</b> \n<br>".
      "<b>Sitio Web: https://www.chibcha-web.eastus.cloudapp.azure.com \n<br>";

$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "Información"; // Asunto del mensaje.
$mail->Body = $mensaje."\n<br>".
"Nombre del usuario: <b>".$nombre."</b>\n<br>".
"Correo del usuario: <b>".$correo."</b>\n<br>".$img;

	// Datos del servidor SMTP, podemos usar el de Google, Outlook, etc...

$mail->IsSMTP(); 
$mail->Host = "ssl://smtp.gmail.com:465";  // Servidor de Salida. 465 es uno de los puertos que usa Google para su servidor SMTP
$mail->SMTPAuth = true;
$mail->Username = $mailCh;  // Correo Electrónico
$mail->Password = "Chibcha.0"; // Contraseña del correo

if (!$mail->Send()){
	echo "<script>alert('Error al enviar el formulario');</script>";
}
header("location: ../view/principal/Home");
?>