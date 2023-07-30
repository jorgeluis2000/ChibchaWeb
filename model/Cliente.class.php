<?php
class Cliente
{
    private $cod_cliente;
    private $pais_cliente;
    private $cod_sitio_web;
    private $estado_cliente;
    private $fecha_ingreso;
    
    function Cliente($pCodigo, $pPais, $pSitio, $pEstado, $pFecha)
    {
        $this->cod_cliente = $pCodigo;
        $this->pais_cliente = $pPais;
        $this->cod_sitio_web = $pSitio;
        $this->estado_cliente = $pEstado;
        $this->fecha_ingreso = $pFecha;
    }

    public function getCodigo()
    {
        return $this->cod_cliente;
    }

    public function getPais()
    {
        return $this->pais_cliente;
    }

    public function getSitio()
    {
        return $this->cod_sitio_web;
    }

    public function getEstado()
    {
        return $this->estado_cliente;
    }

    public function getFecha()
    {
        return $this->fecha_ingreso;
    }
}
?>