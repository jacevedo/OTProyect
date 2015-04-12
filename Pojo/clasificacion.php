<?php
class Clasificacion
{
	public $cla_uid;
	public $cla_snombre;

	function initClass($cla_uid, $cla_snombre)
	{
		$this->cla_uid = $cla_uid;
		$this->cla_snombre = $cla_snombre;
	}
}
?>