<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/controller/database.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/DAO/interfaces/iSitioWeb.interface.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/model/SitioWeb.class.php');

class SitioWebDAO implements iSitioWeb
{
	public function getSitioWeb($pCodigoSitio)
    {
        $db = new Database();
        $db->connect();
        
        $query = "SELECT * FROM SITIO_WEB WHERE cod_sitio_web = $pCodigoSitio";
        $db->doQuery($query, SELECT_QUERY);
        $usArr = $db->results[0];
        
        $pCodigo = $usArr['cod_sitio_web'];
        $pNombre = $usArr['nom_sitio_web'];
        $pLogo = $usArr['logo_sitio_web'];
        $pDescripcion = $usArr['descripcion_sitio_web'];
        $pTipo = $usArr['tipo_sitio_web'];
        
        $sitio = new SitioWeb($pCodigo, $pNombre, $pLogo, $pDescripcion, $pTipo);
        
        $db->disconnect();
        
        return $sitio;
    }

    public function uploadPhoto($pCodigo, $pRuta)
    {
        $db = new Database();
        $db->connect();
        
        $img = "UPDATE SITIO_WEB set logo_sitio_web = '$pRuta' WHERE cod_sitio_web = $pCodigo";
        $db->doQuery($img, UPDATE_QUERY);

        $db->disconnect();

        header("location: ../../modulos/Client/MyProfileClient.php");
    }

    public function uploadSite($pCodigo, $pNombre, $pTipo, $pDescripcion)
    {
        $db = new Database();
        $db->connect();
        
        $query = "UPDATE SITIO_WEB set nom_sitio_web = '$pNombre', descripcion_sitio_web = '$pDescripcion', tipo_sitio_web = '$pTipo' WHERE cod_sitio_web = $pCodigo";
        $db->doQuery($query, UPDATE_QUERY);

        $db->disconnect();

        header("location: ../../modulos/Client/MyProfileClient.php");
    }
}
?>