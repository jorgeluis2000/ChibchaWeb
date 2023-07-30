<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iDominios.interface.php');

class DominiosDAO implements iDominios
{
	public function saveDomain($client, $distri, $nombre, $date, $total, $time, $fPago)
	{
		$db = new Database();
		$db->connect();

		$count = "SELECT * FROM DOMINIOS ORDER BY cod_dominio DESC";
		$db->doQuery($count, SELECT_QUERY);
		$num = $db->results[0];
		$codigo = $num['cod_dominio'];

		$dom = "INSERT INTO DOMINIOS values ($codigo+1, $client, $distri, '$nombre', '$date', $total, '$time', '$fPago')";
		$db->doQuery($dom, INSERT_QUERY);

		$upd = "UPDATE DISTRIBUIDOR set num_dominios = (num_dominios + 1) WHERE cod_distribuidor = $distri";
		$db->doQuery($upd, UPDATE_QUERY);

		$db->disconnect();

		header("location: ../../modulos/Client/DomainsClient");
	}

	public function getDomainList($pCodigo)
	{
		$db = new Database();
		$db->connect();

		$count = "SELECT * FROM DOMINIOS WHERE cod_cliente = $pCodigo";
		$db->doQuery($count, SELECT_QUERY);

		$disArr = $db->results;
		$dominios = array();

		for ($i = 0; $i < sizeof($disArr); $i++)
		{
			$dominios[] = [
				"cod_dominio" => $disArr[$i]['cod_dominio'],
				"cod_cliente" => $disArr[$i]['cod_cliente'],
				"cod_distribuidor" => $disArr[$i]['cod_distribuidor'],
				"nom_dominio" => $disArr[$i]['nom_dominio'],
				"fecha_dominio" => $disArr[$i]['fecha_dominio'],
				"precio_dominio" => $disArr[$i]['precio_dominio'],
				"plazo_dominio" => $disArr[$i]['plazo_dominio'],
				"pago_dominio" => $disArr[$i]['pago_dominio']
			];
		}
		$db->disconnect();

        return $dominios;
	}
}
?>