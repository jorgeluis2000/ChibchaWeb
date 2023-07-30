<?php
class TipoUsuario {
	private $cod_tipo_usuario;
	private $nom_tipo_usuario;

	function TipoUsuario($pCodigoTipo, $pNombreTipo) {
		$this->cod_tipo_usuario;
		$this->nom_tipo_usuario;
	}

	public function getCodigoTipo() {
		return $this->cod_tipo_usuario;
	}

	public function getNombreTipo() {
		return $this->nom_tipo_usuario;
	}
}
?>