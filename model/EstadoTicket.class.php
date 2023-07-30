<?php
class Distribuidor
{
    private $cod_estado_ticket;
    private $nom_estado_ticket;
    
    function Distribuidor($pCodigo, $pNombre)
    {
        $this->cod_estado_ticket = $pCodigo;
        $this->nom_estado_ticket = $pNombre;
    }

    public function getCodigo()
    {
        return $this->cod_estado_ticket;
    }

    public function getNombre()
    {
        return $this->nom_estado_ticket;
    }
}
?>