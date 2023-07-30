<?php
class HostingCliente
{
    private $cod_hosting_cliente;
    private $cod_cliente;
    private $cod_tipo_forma_pago;
    private $cod_hosting;
    private $tiempo_pago;
    private $fecha_pago;
    
    function HostingCliente($pCodigo, $pCliente, $pFormaPago, $pHosting, $pTiempo, $pFecha)
    {
        $this->cod_hosting_cliente = $pCodigo;
        $this->cod_cliente = $pCliente;
        $this->cod_tipo_forma_pago = $pFormaPago;
        $this->cod_hosting = $pHosting;
        $this->tiempo_pago = $pTiempo;
        $this->fecha_pago = $pFecha;
    }

    public function getCodigo()
    {
        return $this->cod_hosting_cliente;
    }

    public function getCliente()
    {
        return $this->cod_cliente;
    }

    public function getFormaPago()
    {
        return $this->cod_tipo_forma_pago;
    }

    public function getHosting()
    {
        return $this->cod_hosting;
    }

    public function getTiempo()
    {
        return $this->tiempo_pago;
    }

    public function getFecha()
    {
        return $this->fecha_pago;
    }
}
?>