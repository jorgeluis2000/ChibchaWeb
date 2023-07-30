<?php

interface iUsuario
{
	public function getData();

	public function saveClient( $pNameUser, $pApeUser, $pDocUser, $pCorUser, $pTeluser, $pPaisUser, $pNomWeb, $pDesWeb, $pTipWeb, $pDestino);

	public function getUsuarioLogin($pCorreo, $pPassword);

	public function UpdatePassword($pCodigo, $pPassword,$tipo);

	public function uploadPhoto($pCodigo, $pRuta);

	public function getAllUsers();

	public function uploadUserAll($pCodigo, $pNombre, $pApellido, $pDocumento, $pCorreo, $pTelefono, $pPais, $pPassword,$pNom_sitio, $pTipo_sitio,$pDescripcion, $pCod_sitio);

	public function getAllDisabledUsers();

	public function getCountUsers();
}

?>
