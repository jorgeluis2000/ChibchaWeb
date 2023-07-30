<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iUsuario.interface.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/model/Usuario.class.php');

class UsuarioDAO implements iUsuario
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
   
   public function saveClient( $pNameUser, $pApeUser, $pDocUser, $pCorUser, $pTeluser, $pPaisUser, $pNomWeb, $pDesWeb, $pTipWeb, $pDestino)
   {
      $db = new Database();
      $db->connect();

      $count1 = "SELECT * FROM USUARIO ORDER BY cod_usuario DESC";
      $db->doQuery($count1, SELECT_QUERY);
      $num1 = $db->results[0];
      $codigo = $num1['cod_usuario'];

      $pass = $this->getData();

      $user = "INSERT INTO USUARIO values ($codigo+1, '$pNameUser', '$pApeUser', '$pDocUser', '$pCorUser', '$pass', 2, '$pTeluser', 'Data/imgs/user.png')";
      $db->doQuery($user, INSERT_QUERY);

      $count = "SELECT * FROM SITIO_WEB ORDER BY cod_sitio_web DESC";
      $db->doQuery($count, SELECT_QUERY);
      $num3 = $db->results[0];
      $codweb = $num3['cod_sitio_web'];

      $sitioWeb = "INSERT INTO SITIO_WEB VALUES ($codweb+1, '$pNomWeb', '$pDestino', '$pDesWeb', '$pTipWeb')";
      $db->doQuery($sitioWeb, INSERT_QUERY);

      $a = date("d");
      $b = date("m");
      $c = date("y");
      $fecha = $a.'/'.$b.'/'.$c;

      $client = "INSERT INTO CLIENTE VALUES ($codigo+1, '$pPaisUser', $codweb+1, 0, '$fecha')";
      $db->doQuery($client, INSERT_QUERY);

      require("../../Data/mailer/class.phpmailer.php"); // Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
      $mail = new PHPMailer();

      $mailCh = 'chweb.info@gmail.com';

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

       header("location: ../../View/principal/TimeLapse?mail=$pCorUser");
   }

   public function getDistributor() 
    {
      $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM USUARIO WHERE cod_tipo_usuario = 3";
        $db->doQuery($query, SELECT_QUERY);
        $disArr = $db->results;

        $distribuidores = array();

      for ($i = 0; $i < sizeof($disArr); $i++)
      {
          $distribuidores[] = [
              "cod_usuario" => $disArr[$i]['cod_usuario'],
              "nom_usuario" => $disArr[$i]['nom_usuario'],
              "ape_usuario" => $disArr[$i]['ape_usuario'],
              "doc_usuario" => $disArr[$i]['doc_usuario'],
              "correo_usuario" => $disArr[$i]['correo_usuario'],
              "pass_usuario" => $disArr[$i]['pass_usuario'],
              "cod_tipo_usuario" => $disArr[$i]['cod_tipo_usuario'],
              "tel_usuario" => $disArr[$i]['tel_usuario'],
              "img_usuario" => $disArr[$i]['img_usuario']
          ];
      }
        $db->disconnect();
        
        return $distribuidores;
    }

   public function getUsuario($codigo)
   {
      $db = new Database();
      $db->connect();
      
      $query = "SELECT * FROM USUARIO WHERE cod_usuario = $codigo";
      $db->doQuery($query, SELECT_QUERY);
      $usArr = $db->results[0];

      $pCodigo = $usArr['cod_usuario'];
      $pNombre = $usArr['nom_usuario'];
      $pApellido = $usArr['ape_usuario'];
      $pDocumento = $usArr['doc_usuario'];
      $pCorreo = $usArr['correo_usuario'];
      $passU = $usArr['pass_usuario'];
      $pCodigoTipo = $usArr['cod_tipo_usuario'];
      $pTelefono = $usArr['tel_usuario'];
      $pImagen = $usArr['img_usuario'];
      
      $usuario = new Usuario($pCodigo, $pNombre, $pApellido, $pDocumento, $pCorreo, $passU, $pCodigoTipo, $pTelefono, $pImagen);
      
      $db->disconnect();
      
      return $usuario;
  }

  public function getUsuarioLogin($pCorreo, $pPassword)
  {
      $db = new Database();
      $db->connect();
      
      $query = "SELECT * FROM USUARIO WHERE correo_usuario = '$pCorreo' AND pass_usuario = '$pPassword'";
      $db->doQuery($query, SELECT_QUERY);
      $usArr = $db->results[0];

      if ($usArr == "" or $usArr == null) {
         return null;
     }
     
     $pCodigo = $usArr['cod_usuario'];
     $pNombre = $usArr['nom_usuario'];
     $pApellido = $usArr['ape_usuario'];
     $pDocumento = $usArr['doc_usuario'];
     $pCorreo = $usArr['correo_usuario'];
     $passU = $usArr['pass_usuario'];
     $pCodigoTipo = $usArr['cod_tipo_usuario'];
     $pTelefono = $usArr['tel_usuario'];
     $pImagen = $usArr['img_usuario'];
     
     $usuario = new Usuario($pCodigo, $pNombre, $pApellido, $pDocumento, $pCorreo, $passU, $pCodigoTipo, $pTelefono, $pImagen);
     
     $db->disconnect();
     
     return $usuario;
  }

  public function UpdatePassword($pCodigo, $pPassword, $tipo)
  {
      $db = new Database();
      $db->connect();
      
      $pass = "UPDATE USUARIO set pass_usuario = '$pPassword' WHERE cod_usuario = $pCodigo";
      $db->doQuery($pass, UPDATE_QUERY);

      $state = "";

      if($tipo == 2) {
        $state = "UPDATE CLIENTE set estado_cliente = 1 WHERE cod_cliente = $pCodigo";
        $db->doQuery($state, UPDATE_QUERY);
      }elseif ($tipo == 3) {
        $state = "UPDATE DISTRIBUIDOR set estado_distribuidor = 1 WHERE cod_distribuidor = $pCodigo";
        $db->doQuery($state, UPDATE_QUERY);
      }elseif ($tipo == 4) {
        $state = "UPDATE EMPLEADO set estado_empleado = 1 WHERE cod_empleado = $pCodigo";
        $db->doQuery($state, UPDATE_QUERY);
      }

      $db->disconnect();

      header("location: ../../Controller/closeSession");
  }

  public function uploadPhoto($pCodigo, $pRuta)
  {
      $db = new Database();
      $db->connect();
      
      $img = "UPDATE USUARIO set img_usuario = '$pRuta' WHERE cod_usuario = $pCodigo";
      $db->doQuery($img, UPDATE_QUERY);

      $db->disconnect();

      header("location: ../../modulos/Client/MyProfileClient");
  }

  public function uploadUser($pCodigo, $pNombre, $pApellido, $pDocumento, $pCorreo, $pTelefono, $pPais, $pPassword)
  {
      $db = new Database();
      $db->connect();
      
      $user = "UPDATE USUARIO set nom_usuario = '$pNombre', ape_usuario = '$pApellido', doc_usuario = '$pDocumento', correo_usuario = '$pCorreo', pass_usuario = '$pPassword', tel_usuario = '$pTelefono' WHERE cod_usuario = $pCodigo";
      $db->doQuery($user, UPDATE_QUERY);

      $client = "UPDATE CLIENTE set pais_cliente = '$pPais' WHERE cod_cliente = $pCodigo";
      $db->doQuery($client, UPDATE_QUERY);

      $db->disconnect();

      header("location: ../../modulos/Client/MyProfileClient");
  }

  public function getAllUsers(){
      $db = new Database();
      $dbc = $db->connect();

      $query = "SELECT cod_usuario, nom_usuario, ape_usuario, doc_usuario, correo_usuario, tel_usuario, pais_cliente,nom_sitio_web, fecha_ingreso
      FROM usuario INNER JOIN cliente ON usuario.cod_usuario = cliente.cod_cliente
      INNER JOIN sitio_web ON cliente.cod_sitio_web = sitio_web.cod_sitio_web WHERE estado_cliente = 1 AND cod_tipo_usuario = 2";

      $db->doQuery($query, SELECT_QUERY);

      $result=mysqli_query($dbc,$query);
      $db->disconnect();
      return $result;
  }

  public function uploadUserAll($pCodigo, $pNombre, $pApellido, $pDocumento, $pCorreo, $pTelefono, $pPais, $pPassword,$pNom_sitio, $pTipo_sitio,$pDescripcion, $pCod_sitio)
  {
      $db = new Database();
      $db->connect();

      $user = "UPDATE usuario set nom_usuario = '$pNombre', ape_usuario = '$pApellido', doc_usuario = '$pDocumento', correo_usuario = '$pCorreo', pass_usuario = '$pPassword', tel_usuario = '$pTelefono' WHERE cod_usuario = $pCodigo";
      $db->doQuery($user, UPDATE_QUERY);

      $client = "UPDATE cliente set pais_cliente = '$pPais' WHERE cod_cliente = $pCodigo";
      $db->doQuery($client, UPDATE_QUERY);

      $sitio = "UPDATE sitio_web set nom_sitio_web = '$pNom_sitio', tipo_sitio_web = '$pTipo_sitio', descripcion_sitio_web = '$pDescripcion' WHERE cod_sitio_web = '$pCod_sitio'";
      $db->doQuery($sitio, UPDATE_QUERY);

      $db->disconnect();

      header("location: ../../modulos/Client/MyProfileClient");
  }

  public function getAllDisabledUsers(){
      $db = new Database();
      $dbc = $db->connect();

      $query = "SELECT cod_usuario, nom_usuario, ape_usuario, doc_usuario, correo_usuario, tel_usuario, pais_cliente,nom_sitio_web, fecha_ingreso
      FROM usuario INNER JOIN cliente ON usuario.cod_usuario = cliente.cod_cliente
      INNER JOIN sitio_web ON cliente.cod_sitio_web = sitio_web.cod_sitio_web WHERE estado_cliente = 0 AND cod_tipo_usuario = 2";

      $db->doQuery($query, SELECT_QUERY);

      $result=mysqli_query($dbc,$query);
      $db->disconnect();
      return $result;
  }

  public function getCountUsers(){
      $db = new Database();
      $conexion = $db->connect();

      $sql = "SELECT COUNT(cod_usuario) from usuario WHERE cod_tipo_usuario != 1 GROUP BY cod_tipo_usuario";
      $result = mysqli_query($conexion, $sql);
      $db->disconnect();

      return $result;
  }

  public function forgetPassword($pCorreo, $pDocumento)
  {
      $db = new Database();
      $conexion = $db->connect();

      $query = "SELECT * FROM USUARIO  WHERE correo_usuario = '$pCorreo' AND doc_usuario = '$pDocumento'";
      $db->doQuery($query, SELECT_QUERY);
      $usArr = $db->results[0];

      $correo = $usArr['correo_usuario'];
      $nombre = $usArr['nom_usuario'];
      $codigo = $usArr['cod_usuario'];

      $pass = $this->getData();

      $client = "UPDATE CLIENTE set estado_cliente = 0 WHERE cod_cliente = $codigo";
      $db->doQuery($client, UPDATE_QUERY);
      $user = "UPDATE USUARIO set pass_usuario = '$pass' WHERE cod_usuario = $codigo";
      $db->doQuery($user, UPDATE_QUERY);

      require("../../Data/mailer/class.phpmailer.php"); // Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
      $mail = new PHPMailer();

      $mailCh = 'chweb.info@gmail.com';

      $mail->From     = $correo;
      $mail->FromName = $nombre; 
      $mail->AddAddress($correo); // Dirección a la que llegaran los mensajes.

  // Aquí van los datos que apareceran en el correo que reciba

      $text = "Será tu contraseña temporal hasta que la cambies.\n<br>";
      
      $img = "<img src='../../../Data/imgs/ChibchaWeb.png' style='width: 100px; height: 100px; margin-top: 30px;'\n<br><p></p>".
      "<b>Correo de contácto: chweb.info@gmail.com</b> \n<br>".
      "<b>Número de contácto: 3102057439 - 3105508980</b> \n<br>".
      "<b>Sitio Web: https://www.chibcha-web.eastus.cloudapp.azure.com \n<br>";
      
      $mail->WordWrap = 50; 
      $mail->IsHTML(true);
      $mail->Subject  =  "Recuperación de contraseña"; // Asunto del mensaje.
      $mail->Body     =  "¡ Hola $nombre ! \n<br />". // Nombre del usuario
      "Haz perdido tu contraseña en Chibcha Web, recupérala. \n<br>".
      "Usa el siguiente código para completar el proceso. <b>$pass</b> \n<br>".$text.$img;

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

       header("location: ../../View/principal/TimeLapse.php?mail=$correo");
  }
}
?>