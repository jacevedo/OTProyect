<?php
class PlanOT
{
	public $pln_uid;
	public $pln_dfechaHoraPlan;
	public $pln_sdescripcion;
	public $pln_dfechaHoraEmisionIdeal;
	public $fk_per_uid;
	public $fk_tipest_uid;

	function initClass($pln_uid, $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid)
	{
		$this->pln_uid = $pln_uid;
		$this->pln_dfechaHoraPlan = $pln_dfechaHoraPlan;
		$this->pln_sdescripcion = $pln_sdescripcion;
		$this->pln_dfechaHoraEmisionIdeal = $pln_dfechaHoraEmisionIdeal;
		$this->fk_per_uid = $fk_per_uid;
		$this->fk_tipest_uid = $fk_tipest_uid;
	}
}
?>