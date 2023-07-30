<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iHostingCliente.interface.php');

class HostingClienteDAO implements iHostingCliente
{
	public function savePurchase($pCodigo, $pFormaPago, $pHosting, $pTiempo, $pFecha) 
	{
		$db = new Database();
		$db->connect();

		$count = "SELECT * FROM HOSTING_CLIENTE ORDER BY cod_hosting_cliente DESC";
		$db->doQuery($count, SELECT_QUERY);
		$num = $db->results[0];
		$codigo = $num['cod_hosting_cliente'];

		$hosCli = "INSERT INTO HOSTING_CLIENTE VALUES ($codigo+1, $pCodigo, '$pFormaPago', $pHosting, '$pTiempo', '$pFecha')";
		$db->doQuery($hosCli, INSERT_QUERY);

		$db->disconnect();

		header("location: ../../modulos/Client/ProfileClient");
	}

	public function getHostingList($pCodigo) 
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM HOSTING_CLIENTE WHERE cod_cliente = '$pCodigo'";
        $db->doQuery($query, SELECT_QUERY);
        $hoArr = $db->results;

        $hostings = array();

        for ($i = 0; $i < sizeof($hoArr); $i++)
        {
            $hostings[] = [
                "cod_hosting_cliente" => $hoArr[$i]['cod_hosting_cliente'],
                "cod_cliente" => $hoArr[$i]['cod_cliente'],
                "cod_tipo_forma_pago" => $hoArr[$i]['cod_tipo_forma_pago'],
                "cod_hosting" => $hoArr[$i]['cod_hosting'],
                "tiempo_pago" => $hoArr[$i]['tiempo_pago'],
                "fecha_pago" => $hoArr[$i]['fecha_pago']
            ];
        }
        $db->disconnect();
        
        return $hostings;
    }
}
?>