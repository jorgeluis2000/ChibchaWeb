<?php

interface iEmpleado
{
    public function getAllEmpleados();

    public function getEmpleado($pCodigo);

    public function uploadEmpleado($pCodigo, $pNombre, $pApellido, $pDocumento, $pCorreo, $pTelefono, $pCodTipoEmpleado, $pPais, $pPassword);

    public function getAllDisabledEmpleados();

    public function saveEmpleado( $pNameUser, $pApeUser, $pDocUser, $pCorUser, $pTeluser, $pPaisUser, $cod_tipo_empleado);
}
?>