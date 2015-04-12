<?php
class Falla
{
	public $fal_uid;
	public $fal_sdescripcion;
	public $cla_uid;

	function initClass($fal_uid, $fal_sdescripcion, $cla_uid)
	{
		$this->fal_uid = $fal_uid;
		$this->fal_sdescripcion = $fal_sdescripcion;
		$this->cla_uid = $cla_uid;
	}
}
?>