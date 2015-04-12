<?php
class OTDetalle
{
	public $det_uid;
	public $det_dfechaComienzo;
	public $det_dfechaTermino;
	public $det_ncoordenadaX;
	public $det_ncoordenadaY;
	public $det_sdescripcion;
	public $fk_res_uid;
	public $fk_pln_uid;
	public $fk_fal_uid;
	public $fk_ser_uid;

	function initClass($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
									$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
									$fk_fal_uid, $fk_ser_uid)
	{
		$this->det_uid = $det_uid;
		$this->det_dfechaComienzo = $det_dfechaComienzo;
		$this->det_dfechaTermino = $det_dfechaTermino;
		$this->det_ncoordenadaX = $det_ncoordenadaX;
		$this->det_ncoordenadaY = $det_ncoordenadaY;
		$this->det_sdescripcion = $det_sdescripcion;
		$this->fk_res_uid = $fk_res_uid;
		$this->fk_pln_uid = $fk_pln_uid;
		$this->fk_fal_uid = $fk_fal_uid;
		$this->fk_ser_uid = $fk_ser_uid;
	}
}
?>