<?php
class Posterga
{
	public $pos_uid;
	public $pos_dfechaInicio;
	public $pos_dfechaFinal;
	public $fk_per_uid;

	function initClass($pos_uid, $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid)
	{
		$this->pos_uid = $pos_uid;
		$this->pos_dfechaInicio = $pos_dfechaInicio;
		$this->pos_dfechaFinal = $pos_dfechaFinal;
		$this->fk_per_uid = $fk_per_uid;
	}
}
?>