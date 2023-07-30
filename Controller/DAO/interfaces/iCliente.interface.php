<?php

interface iCliente
{
	public function getClienteLogin($pCodigoUser);

	public function getCliente($pCodigo);

	public function desactivarCliente($pCodigo);

	public function activarCliente($pCodigo);

	public function getCountClientesOrder();
}
?>
