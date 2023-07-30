<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/model/CategoriaDistribuidor.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iCategoriaDistribuidor.interface.php');

class CategoriaDistribuidorDAO implements iCategoriaDistribuidor
{
	public function getCategoriaDistribuidor($codigo) 
        {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM CATEGORIA_DISTRIBUIDOR WHERE cod_categoria_distribuidor = $codigo";
        $db->doQuery($query, SELECT_QUERY);
        $catArr = $db->results[0];

        $codCat = $catArr['cod_categoria_distribuidor'];
        $nomCat = $catArr['nom_categoria_distribuidor'];
        $tasaCat = $catArr['tasa_interes_categoria'];
        
        $categoria = new CategoriaDistribuidor($codCat, $nomCat, $tasaCat);
        
        $db->disconnect();
        
        return $categoria;
	}
}
