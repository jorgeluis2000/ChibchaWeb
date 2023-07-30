<?php

interface iSitioWeb
{
	public function getSitioWeb($pCodigoSitio);

	public function uploadPhoto($pCodigo, $pRuta);

	public function uploadSite($pCodigo, $pNombre, $pTipo, $pDescripcion);
}
?>