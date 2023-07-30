<?php
class Usuario {
	private $cod_usuario;
	private $nom_usuario;
	private $ape_usuario;
	private $doc_usuario;
	private $correo_usuario;
	private $pass_usuario;
	private $cod_tipo_usuario;
	private $tel_usuario;
	private $img_usuario;

	function Usuario($pCodigo, $pNombre, $pApellido, $pDocumento, $pCorreo, $pContrasenia, $pCodigoTipo, $pTelefono, $pImagen) {
		$this->cod_usuario = $pCodigo;
		$this->nom_usuario = $pNombre;
		$this->ape_usuario = $pApellido;
		$this->doc_usuario = $pDocumento;
		$this->correo_usuario = $pCorreo;
		$this->pass_usuario = $pContrasenia;
		$this->cod_tipo_usuario = $pCodigoTipo;
		$this->tel_usuario = $pTelefono;
		$this->img_usuario = $pImagen;
	}

	public function getCodigoUsuario() {
		return $this->cod_usuario;
	}

	public function getNombreUsuario() {
		return $this->nom_usuario;
	}

	public function getApellidoUsuario() {
		return $this->ape_usuario;
	}

	public function getDocumentoUsuario() {
		return $this->doc_usuario;
	}

	public function getCorreoUsuario() {
		return $this->correo_usuario;
	}

	public function getContraseniaUsuario() {
		return $this->pass_usuario;
	}

	public function getCodigoTipoUsuario() {
		return $this->cod_tipo_usuario;
	}

	public function getTelefonoUsuario() {
		return $this->tel_usuario;
	}

	public function getImagenUsuario() {
		return $this->img_usuario;
	}
}
?>