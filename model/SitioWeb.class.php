<?php
class SitioWeb {
	private $cod_sitio_web;
	private $nom_sitio_web;
	private $logo_sitio_web;
	private $descripcion_sitio_web;
	private $tipo_sitio_web;


	function SitioWeb($pCodigoSitio, $pNombreSitio, $pLogoSitio, $pDescripcion, $pTipoSitio) {
		$this->cod_sitio_web = $pCodigoSitio;
		$this->nom_sitio_web = $pNombreSitio;
		$this->logo_sitio_web = $pLogoSitio;
		$this->descripcion_sitio_web = $pDescripcion;
		$this->tipo_sitio_web = $pTipoSitio;
	}

	public function getCodigoSitioWeb() {
		return $this->cod_sitio_web;
	}

	public function getNombreSitioWeb() {
		return $this->nom_sitio_web;
	}

	public function getLogo() {
		return $this->logo_sitio_web;
	}

	public function getDescripcionSitioWeb() {
		return $this->descripcion_sitio_web;
	}

	public function getTipoSitioWeb() {
		return $this->tipo_sitio_web;
	}
}
?>