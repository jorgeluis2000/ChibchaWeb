<?php
class Ticket {
	private $cod_ticket;
	private $cod_usuario;
	private $asunto_ticket;
	private $descripcion_ticket;
	private $cod_estado_ticket;
	private $fecha;

	function Ticket($pTicket, $pUsuario, $pAsuntoTicket, $pDescription, $pCodigoEstado, $pFecha) {
		$this->cod_ticket = $pTicket;
		$this->cod_usuario = $pUsuario;
		$this->asunto_ticket = $pAsuntoTicket;
		$this->descripcion_ticket = $pDescription;
		$this->cod_estado_ticket = $pCodigoEstado;
		$this->fecha = $pFecha;
	}

	public function getCodigoTicket() {
		return $this->cod_ticket;
	}

	public function getCodigoUsuario() {
		return $this->cod_usuario;
	}

	public function getAsuntoTicket() {
		return $this->asunto_ticket;
	}

	public function getDescripcionTicket() {
		return $this->descripcion_ticket;
	}

	public function getCodigoEstadoTicket() {
		return $this->cod_estado_ticket;
	}

	public function getFecha() {
		return $this->fecha;
	}
}
?>