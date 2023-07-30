<?php
class TipoEmpleado {
	private $cod_tipo_empleado;
	private $nom_tipo_empleado;

	function TipoEmpleado($pCodigoTipo, $pNombreTipo) {
		$this->cod_tipo_empleado = $pCodigoTipo;
		$this->nom_tipo_empleado = $pNombreTipo;
	}

	public function getCodigoTipoEmpleado() {
		return $this->cod_tipo_empleado;
	}

	public function getNombreTipoEmpleado() {
		return $this->nom_tipo_empleado;
	}	
}
?>