<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iTipoEmpleado.interface.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Model/TipoEmpleado.class.php');

class TipoEmpleadoDAO implements iTipoEmpleado
{
	public function getTipoEmpleado($pCodigo){
		$db = new Database();
		$db->connect();

		$query = "SELECT * FROM tipo_empleado WHERE cod_tipo_empleado = '$pCodigo'";
		$db->doQuery($query, SELECT_QUERY);
		$usArr = $db->results[0];

		$pCodigo = $usArr['cod_tipo_empleado'];
		$pNom = $usArr['nom_tipo_empleado'];

		$tipoEmpleado = new TipoEmpleado($pCodigo, $pNom);

		$db->disconnect();

		return $tipoEmpleado;
	}
}
?>	