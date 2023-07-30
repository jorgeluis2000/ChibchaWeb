<?php
class Dominios
{
    private $cod_dominio;
    private $cod_cliente;
    private $cod_distribuidor;
    private $nom_dominio;
    private $fecha_dominio;
    private $precio_dominio;
    private $plazo_dominio;
    private $pago_dominio;
    
    function Dominios($pCodigo, $pCliente, $pDistribuidor, $pDominio, $pFecha, $pPrecio, $pPlazo, $pPago)
    {
        $this->cod_dominio = $pCodigo;
        $this->cod_cliente = $pCliente;
        $this->cod_distribuidor = $pDistribuidor;
        $this->nom_dominio = $pDominio;
        $this->fecha_dominio = $pFecha;
        $this->precio_dominio = $pPrecio;
        $this->plazo_dominio = $pPlazo;
        $this->pago_dominio = $pPago;
    }

    public function getCodigo()
    {
        return $this->cod_dominio;
    }

    public function getCliente()
    {
        return $this->cod_cliente;
    }

    public function getDistribuidor()
    {
        return $this->cod_distribuidor;
    }

    public function getDominio()
    {
        return $this->nom_dominio;
    }

    public function getFecha()
    {
        return $this->fecha_dominio;
    }

    public function getPrecio()
    {
        return $this->precio_dominio;
    }

    public function getPlazo()
    {
        return $this->plazo_dominio;
    }

    public function getPago()
    {
        return $this->pago_dominio;
    }
}
?>