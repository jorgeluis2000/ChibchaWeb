<?php
class Distribuidor
{
    private $cod_distribuidor;
    private $cod_categoria_distribuidor;
    private $estado_distribuidor;
    private $num_dominios;
    private $url_distribuidor;
    private $nom_propietario;
    private $banco_tarjeta;
    private $num_tarjeta;
    
    function Distribuidor($pCodigo, $pCategoria, $pEstado, $pNumero, $pUrl, $pPropietario, $pBanco, $pTarjeta)
    {
        $this->cod_distribuidor = $pCodigo;
        $this->cod_categoria_distribuidor = $pCategoria;
        $this->estado_distribuidor = $pEstado;
        $this->num_dominios = $pNumero;
        $this->url_distribuidor = $pUrl;
        $this->nom_propietario = $pPropietario;
        $this->banco_tarjeta = $pBanco;
        $this->num_tarjeta = $pTarjeta;
    }

    public function getCodigo()
    {
        return $this->cod_distribuidor;
    }

    public function getCategoria()
    {
        return $this->cod_categoria_distribuidor;
    }

    public function getEstado()
    {
        return $this->estado_distribuidor;
    }

    public function getNumero()
    {
        return $this->num_dominios;
    }

    public function getUrl()
    {
        return $this->url_distribuidor;
    }

    public function getPropietario()
    {
        return $this->nom_propietario;
    }

    public function getBanco()
    {
        return $this->banco_tarjeta;
    }

    public function getTarjeta()
    {
        return $this->num_tarjeta;
    }
}
?>