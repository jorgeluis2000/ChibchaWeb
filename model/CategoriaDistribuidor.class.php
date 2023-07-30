<?php
class CategoriaDistribuidor
{
    private $cod_categoria_distribuidor;
    private $nom_categoria_distribuidor;
    private $tasa_interes_categoria;
    
    function CategoriaDistribuidor($pCodigo, $pNombre, $pTasa)
    {
        $this->cod_categoria_distribuidor = $pCodigo;
        $this->nom_categoria_distribuidor = $pNombre;
        $this->tasa_interes_categoria = $pTasa;
    }

    public function getCodigo()
    {
        return $this->cod_categoria_distribuidor;
    }

    public function getNombre()
    {
        return $this->nom_categoria_distribuidor;
    }

    public function getTasa()
    {
        return $this->tasa_interes_categoria;
    }
}
?>