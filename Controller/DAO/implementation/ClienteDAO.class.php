<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/controller/DAO/interfaces/iCliente.interface.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/model/Cliente.class.php');

class ClienteDAO implements iCliente
{
	public function getClienteLogin($pCodigoUser)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM CLIENTE WHERE cod_cliente = $pCodigoUser";
        $db->doQuery($query, SELECT_QUERY);
        $usArr = $db->results[0];
        
        $pCodigo = $usArr['cod_cliente'];
        $pPais = $usArr['pais_cliente'];
        $pSitio = $usArr['cod_sitio_web'];
        $pEstado = $usArr['estado_cliente'];
        $pFecha = $usArr['fecha_ingreso'];
        
        $cliente = new Cliente($pCodigo, $pPais, $pSitio, $pEstado, $pFecha);
        
        $db->disconnect();
        
        return $cliente;
    }

    public function getCliente($pCodigo)
    {
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM cliente WHERE cod_cliente = '$pCodigo'";
        $db->doQuery($query, SELECT_QUERY);
        $usArr = $db->results[0];

        $pCodigo = $usArr['cod_cliente'];
        $pPais = $usArr['pais_cliente'];
        $pSitio = $usArr['cod_sitio_web'];
        $pEstado = $usArr['estado_cliente'];
        $pFecha = $usArr['fecha_ingreso'];

        $cliente = new Cliente($pCodigo, $pPais, $pSitio, $pEstado, $pFecha);

        $db->disconnect();

        return $cliente;

    }

    public function desactivarCliente($pCodigo)
    {
        $db = new Database();
        $db->connect();

        $user = "UPDATE cliente SET estado_cliente = 0 WHERE cod_cliente = '$pCodigo'";
        $db->doQuery($user, UPDATE_QUERY);

        $db->disconnect();
    }

    public function activarCliente($pCodigo)
    {
        $db = new Database();
        $db->connect();

        $user = "UPDATE cliente SET estado_cliente = 1 WHERE cod_cliente = '$pCodigo'";
        $db->doQuery($user, UPDATE_QUERY);

        $db->disconnect();
    }

    public function getCountClientesOrder()
    {
        $db = new Database();
        $conexion = $db->connect();

        $sql = "SELECT count(fecha_ingreso),pais_cliente from cliente GROUP BY pais_cliente";
        $result = mysqli_query($conexion, $sql);

        $db->disconnect();

        return $result;
    }
}
?>