<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iDistribuidor.interface.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/model/CategoriaDistribuidor.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/model/Distribuidor.class.php');

class DistribuidorDAO implements iDistribuidor
{
    public function saveDistribuidor($pNombre, $pNit, $pCorreo, $pTelefono, $pUrl, $pImg) 
    {
        $db = new Database();
        $db->connect();

        $count = "SELECT * FROM USUARIO ORDER BY cod_usuario DESC";
        $db->doQuery($count, SELECT_QUERY);
        $num = $db->results[0];
        $codigo = $num['cod_usuario'];

        $user = "INSERT INTO USUARIO values ($codigo+1, '$pNombre', '', '$pNit', '$pCorreo', '', 3, '$pTelefono', '$pImg')";
        $db->doQuery($user, INSERT_QUERY);

        $dist = "INSERT INTO DISTRIBUIDOR values ($codigo+1, 1, 0, 0, '$pUrl', '', '', '')";
        $db->doQuery($dist, INSERT_QUERY);

        $db->disconnect();

        header("location: ../../View/principal/TimeLapse?mail=1");
    }

    public function uploadDistributor($pCodigo, $pNombre, $pDocumento, $pCorreo, $pTelefono, $pUrl, $pPassword)
    {
      $db = new Database();
      $db->connect();
      
      $user = "UPDATE USUARIO set nom_usuario = '$pNombre', ape_usuario = '$pApellido', doc_usuario = '$pDocumento', correo_usuario = '$pCorreo', pass_usuario = '$pPassword', tel_usuario = '$pTelefono' WHERE cod_usuario = $pCodigo";
      $db->doQuery($user, UPDATE_QUERY);

      $distribuidor = "UPDATE DISTRIBUIDOR set url_distribuidor = '$pUrl' WHERE cod_distribuidor = $pCodigo";
      $db->doQuery($distribuidor, UPDATE_QUERY);

      $db->disconnect();

      header("location: ../../modulos/Distributor/MyProfileDistributor");
    }

    public function uploadPhoto($pCodigo, $pRuta)
    {
      $db = new Database();
      $db->connect();
      
      $img = "UPDATE USUARIO set img_usuario = '$pRuta' WHERE cod_usuario = $pCodigo";
      $db->doQuery($img, UPDATE_QUERY);

      $db->disconnect();

      header("location: ../../modulos/Distributor/MyProfileDistributor");
    }

    public function getDistribuidor($codigo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM DISTRIBUIDOR WHERE cod_distribuidor = $codigo";
        $db->doQuery($query, SELECT_QUERY);
        $disArr = $db->results[0];

        $codDis = $disArr['cod_distribuidor'];
        $catDis = $disArr['cod_categoria_distribuidor'];
        $estDis = $disArr['estado_distribuidor'];
        $numDis = $disArr['num_dominios'];
        $urlDis = $disArr['url_distribuidor'];
        $nomPro = $disArr['nom_propietario'];
        $banco = $disArr['banco_tarjeta'];
        $card = $disArr['num_tarjeta'];
        
        $distribuidor = new Distribuidor($codDis, $catDis, $estDis, $numDis, $urlDis, $nomPro, $banco, $card);
        
        $db->disconnect();
        
        return $distribuidor;
    }

    public function getListaDistribuidor() 
    {
    	$db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM DISTRIBUIDOR";
        $db->doQuery($query, SELECT_QUERY);
        $disArr = $db->results;

        $distribuidores = array();

	    for ($i = 0; $i < sizeof($disArr); $i++)
	    {
	        $distribuidores[] = [
	            "cod_distribuidor" => $disArr[$i]['cod_distribuidor'],
	            "cod_categoria_distribucion" => $disArr[$i]['cod_categoria_distribucion'],
	            "estado_distribuidor" => $disArr[$i]['estado_distribuidor'],
              "num_dominios" => $disArr[$i]['num_dominios'],
              "url_distribuidor" => $disArr[$i]['url_distribuidor'],
              "nom_propietario" => $disArr[$i]['nom_propietario'],
              "banco_tarjeta" => $disArr[$i]['banco_tarjeta'],
              "num_tarjeta" => $disArr[$i]['num_tarjeta']
	        ];
	    }
        
        $db->disconnect();
        
        return $distribuidores;
    }
}
?>