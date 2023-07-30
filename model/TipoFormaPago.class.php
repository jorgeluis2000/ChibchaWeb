<?php
class TipoFormaPago {
	
	private $cod_tipo_pago;
	private $cod_franquicia;
	private $nom_tipo_pago;

	function TipoFormaPago($pCodigoTipoPago, $pFranquicia, $pNombreTipoPago) {
		$this->cod_tipo_pago = $pCodigoTipoPago;
		$this->cod_franquicia = $pFranquicia;
		$this->nom_tipo_pago = $pNombreTipoPago;
	}

	public function getCodigoTipoPago() {
		return $this->cod_tipo_pago;
	}

	public function getCodigoFranquicia() {
		return $this->cod_franquicia;
	}
	
	public function getNombreTipoPago() {
		return $this->nom_tipo_pago;
	}
}
?>