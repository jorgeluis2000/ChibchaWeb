<?php
class Hosting
{
    private $cod_hosting;
    private $cod_distribuidor;
    private $tipo_hosting;
    private $valor_mensual;
    private $datos_hosting;
    
    function Hosting($pCodigo, $pDistribuidor, $pTipo, $pValor, $pDatos)
    {
        $this->cod_hosting = $pCodigo;
        $this->cod_distribuidor = $pDistribuidor;
        $this->tipo_hosting = $pTipo;
        $this->valor_mensual = $pValor;
        $this->datos_hosting = $pDatos;
    }

    public function getCodigo()
    {
        return $this->cod_hosting;
    }

    public function getDistribuidor()
    {
        return $this->cod_distribuidor;
    }

    public function getTipo()
    {
        return $this->tipo_hosting;
    }

    public function getValor()
    {
        return $this->valor_mensual;
    }

    public function getDatos()
    {
        return $this->datos_hosting;
    }
}
?>