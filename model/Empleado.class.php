<?php
class Empleado
{
    private $cod_empleado;
    private $cod_tipo_empleado;
    
    function Empleado($pCodigo, $pTipo)
    {
        $this->cod_empleado = $pCodigo;
        $this->cod_tipo_empleado = $pTipo;
    }

    public function getCodigo()
    {
        return $this->cod_empleado;
    }

    public function getTipo()
    {
        return $this->cod_tipo_empleado;
    }
}
?>