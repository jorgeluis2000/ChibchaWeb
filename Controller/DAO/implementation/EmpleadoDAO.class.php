<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iEmpleado.interface.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Model/Empleado.class.php');

class EmpleadoDAO implements iEmpleado
{
	public function getData()
	{
		$key = "";
		$words = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		for ($i=0; $i < 3; $i++) {
			$num = rand(1,10);
			$pos = rand(0,sizeof($words));
			$key = $key.$num.$words[$pos];
		}
		return $key;
	}

	public function getAllEmpleados()
	{
		$db = new Database();
		$dbc = $db->connect();

		$query = "SELECT  DISTINCT cod_usuario, nom_usuario, ape_usuario, doc_usuario, correo_usuario, tel_usuario,cod_tipo_usuario,
		nom_tipo_empleado,pais_cliente,fecha_ingreso, estado_cliente
		FROM usuario INNER JOIN empleado ON usuario.cod_usuario = empleado.cod_empleado
		INNER JOIN tipo_empleado ON usuario.cod_usuario = empleado.cod_empleado INNER JOIN cliente ON cliente.estado_cliente = 1 AND cliente.cod_cliente = usuario.cod_usuario";

		$db->doQuery($query, SELECT_QUERY);

		$result=mysqli_query($dbc,$query);
		$db->disconnect();
		return $result;
	}

	public function getEmpleado($pCodigo)
	{
		$db = new Database();
		$db->connect();

		$query = "SELECT * FROM empleado WHERE cod_empleado = '$pCodigo'";
		$db->doQuery($query, SELECT_QUERY);
		$usArr = $db->results[0];

		$pCodigo = $usArr['cod_empleado'];
		$pCodTipo = $usArr['cod_tipo_empleado'];

		$tipoEmpleado = new Empleado($pCodigo, $pCodTipo);

		$db->disconnect();

		return $tipoEmpleado;
	}

	public function uploadEmpleado($pCodigo, $pNombre, $pApellido, $pDocumento, $pCorreo, $pTelefono, $pCodTipoEmpleado, $pPais, $pPassword)
	{
		$db = new Database();
		$db->connect();

		$user = "UPDATE usuario set nom_usuario = '$pNombre', ape_usuario = '$pApellido', doc_usuario = '$pDocumento', correo_usuario = '$pCorreo', pass_usuario = '$pPassword', tel_usuario = '$pTelefono' WHERE cod_usuario = '$pCodigo'";
		$db->doQuery($user, UPDATE_QUERY);

		$client = "UPDATE cliente set pais_cliente = '$pPais' WHERE cod_cliente = $pCodigo";
		$db->doQuery($client, UPDATE_QUERY);

		$empleado = "UPDATE empleado set cod_tipo_empleado = '$pCodTipoEmpleado' WHERE cod_empleado = '$pCodigo'";
		$db->doQuery($empleado, UPDATE_QUERY);

		$db->disconnect();
	}

	public function getAllDisabledEmpleados(){
		$db = new Database();
		$dbc = $db->connect();

		$query = "SELECT  DISTINCT cod_usuario, nom_usuario, ape_usuario, doc_usuario, correo_usuario, tel_usuario,cod_tipo_usuario,
		nom_tipo_empleado,pais_cliente,fecha_ingreso, estado_cliente
		FROM usuario INNER JOIN empleado ON usuario.cod_usuario = empleado.cod_empleado
		INNER JOIN tipo_empleado ON usuario.cod_usuario = empleado.cod_empleado INNER JOIN cliente ON cliente.estado_cliente = 0 AND cliente.cod_cliente = usuario.cod_usuario";

		$db->doQuery($query, SELECT_QUERY);

		$result=mysqli_query($dbc,$query);
		$db->disconnect();
		return $result;
	}

	public function saveEmpleado( $pNameUser, $pApeUser, $pDocUser, $pCorUser, $pTeluser, $pPaisUser, $cod_tipo_empleado)
	{
		$db = new Database();
		$db->connect();

		$count1 = "SELECT * FROM usuario ORDER BY cod_usuario DESC";
		$db->doQuery($count1, SELECT_QUERY);
		$num1 = $db->results[0];
		$codigo = $num1['cod_usuario'];
		$cod = $codigo+1;

		$pass = $this->getData();

		$a = date("d");
		$b = date("m");
		$c = date("y");
		$fecha = $a.'/'.$b.'/'.$c;

		$mailCh = 'chweb.info@gmail.com';

		$user = "INSERT INTO usuario values ($cod, '$pNameUser', '$pApeUser', '$pDocUser', '$pCorUser', '$pass', 4, '$pTeluser', 'Data/imgs/user.png')";
		$db->doQuery($user, INSERT_QUERY);

		$client = "INSERT INTO empleado VALUES ($cod, $cod_tipo_empleado)";
		$db->doQuery($client, INSERT_QUERY);

        require("../../../Data/mailer/class.phpmailer.php"); // Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
        $mail = new PHPMailer();

        $mail->From     = $pCorUser;
        $mail->FromName = $pNameUser;
	    $mail->AddAddress($pCorUser); // Dirección a la que llegaran los mensajes.

	// Aquí van los datos que apareceran en el correo que reciba

	$text = "Será tu contraseña temporal hasta que la cambies.";

	$img = "<img src='../../../Data/imgs/ChibchaWeb.png' style='width: 100px; height: 100px; margin-top: 30px;'\n<br><p></p>".
      "<b>Correo de contácto: chweb.info@gmail.com</b> \n<br>".
      "<b>Número de contácto: 3102057439 - 3105508980</b> \n<br>".
      "<b>Sitio Web: https://www.chibcha-web.eastus.cloudapp.azure.com \n<br>";

	    $mail->WordWrap = 50;
	    $mail->IsHTML(true);
	    $mail->Subject  =  "Registro de usuario"; // Asunto del mensaje.
	    $mail->Body     =  "¡ Hola $pNameUser ! \n<br />". // Nombre del usuario
	    "Bienvenido a Chibcha Web, se parte de nosotros. \n<br>".
	    "Usa el siguiente código para completar tu registro. <b>$pass</b> \n<br>".$text.$img;

	// Datos del servidor SMTP, podemos usar el de Google, Outlook, etc...

	    $mail->IsSMTP();
	    $mail->Host = "ssl://smtp.gmail.com:465";  // Servidor de Salida. 465 es uno de los puertos que usa Google para su servidor SMTP
	    $mail->SMTPAuth = true;
	    $mail->Username = $mailCh;  // Correo Electrónico
	    $mail->Password = "Chibcha.0"; // Contraseña del correo

	    if ($mail->Send()){
	    	echo "<script>alert('Formulario enviado exitosamente');</script>";
	    }else{
	    	echo "<script>alert('Error al enviar el formulario');</script>";
	    }

	    $db->disconnect();

	    header("location: ../../modulos/Admin/EmpleadosData.php");
	}
}
?>