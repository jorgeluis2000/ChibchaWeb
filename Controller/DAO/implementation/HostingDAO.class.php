<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iHosting.interface.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/model/Hosting.class.php');

class HostingDAO implements iHosting
{

    public function saveHosting($pCodigo, $pValorA, $pValorB, $pValorC, $pDatosA, $pDatosB, $pDatosC, $pPropietario, $pBanco, $pTarjeta) {

        $db = new Database();
        $db->connect();

        $count1 = "SELECT * FROM HOSTING ORDER BY cod_hosting DESC";
        $db->doQuery($count1, SELECT_QUERY);
        $num1 = $db->results[0];
        $codigo = $num1['cod_hosting'];

        $userA = "INSERT INTO HOSTING values ($codigo+1, $pCodigo, 'Platino', $pValorA, '$pDatosA')";
        $db->doQuery($userA, INSERT_QUERY);

        $userB = "INSERT INTO HOSTING values ($codigo+2, $pCodigo, 'Plata', $pValorB, '$pDatosB')";
        $db->doQuery($userB, INSERT_QUERY);

        $userC = "INSERT INTO HOSTING values ($codigo+3, $pCodigo, 'Oro', $pValorC, '$pDatosC')";
        $db->doQuery($userC, INSERT_QUERY);

        $card = "UPDATE DISTRIBUIDOR set nom_propietario = '$pPropietario', banco_tarjeta = '$pBanco', num_tarjeta = '$pTarjeta' WHERE cod_distribuidor = $pCodigo";
        $db->doQuery($card, UPDATE_QUERY);

        $db->disconnect();

        header("location: ../../modulos/Distributor/ProfileDistributor");
    }
	public function getHosting($codigo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM HOSTING WHERE cod_hosting = $codigo";
        $db->doQuery($query, SELECT_QUERY);
        $hoArr = $db->results[0];

        $cod_hosting = $hoArr['cod_hosting'];
        $cod_distribuidor = $hoArr['cod_distribuidor'];
        $tipo_hosting = $hoArr['tipo_hosting'];
        $valor_mensual = $hoArr['valor_mensual'];
        $datos_hosting = $hoArr['datos_hosting'];
        
        $hosting = new Hosting($cod_hosting, $cod_distribuidor, $tipo_hosting, $valor_mensual, $datos_hosting);
        
        $db->disconnect();
        
        return $hosting;
    }

    public function getListaHosting() 
    {
    	$db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM HOSTING";
        $db->doQuery($query, SELECT_QUERY);
        $hoArr = $db->results;

        $hostings = array();

	    for ($i = 0; $i < sizeof($hoArr); $i++)
	    {
	        $hostings[] = [
	            "cod_hosting" => $hoArr[$i]['cod_hosting'],
	            "cod_distribuidor" => $hoArr[$i]['cod_distribuidor'],
	            "tipo_hosting" => $hoArr[$i]['tipo_hosting'],
	            "valor_mensual" => $hoArr[$i]['valor_mensual'],
	            "datos_hosting" => $hoArr[$i]['datos_hosting']
	        ];
	    }
        $db->disconnect();
        
        return $hostings;
    }

    public function getListaHostingPlan($tipo) 
    {
    	$db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM HOSTING WHERE tipo_hosting = '$tipo'";
        $db->doQuery($query, SELECT_QUERY);
        $hoArr = $db->results;

        $hostings = array();

	    for ($i = 0; $i < sizeof($hoArr); $i++)
	    {
	        $hostings[] = [
	            "cod_hosting" => $hoArr[$i]['cod_hosting'],
	            "cod_distribuidor" => $hoArr[$i]['cod_distribuidor'],
	            "tipo_hosting" => $hoArr[$i]['tipo_hosting'],
	            "valor_mensual" => $hoArr[$i]['valor_mensual'],
	            "datos_hosting" => $hoArr[$i]['datos_hosting']
	        ];
	    }
        $db->disconnect();
        
        return $hostings;
    }

    public function getMinorHosting($tipo)
    {
        $db = new Database();
        $db->connect();
        
        $query = "select * from hosting WHERE tipo_hosting = '$tipo' group by valor_mensual ASC";
        $db->doQuery($query, SELECT_QUERY);
        $hoArr = $db->results[0];

        $valor_mensual = $hoArr['valor_mensual'];
        
        
        $db->disconnect();
        
        return $valor_mensual;
    }

    public function validatorHost($codigo)
    {
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM HOSTING WHERE cod_distribuidor = $codigo";
        $db->doQuery($query, SELECT_QUERY);
        $res = $db->results[0];

        $rta = 1;

        if ($res == null) {
            $rta = 0;
        }
        return $rta;
    }
}
?>