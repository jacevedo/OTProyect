<?php
class Servicio
{
	public $ser_uid;
	public $ser_snombre;

	function initClass($ser_uid, $ser_snombre)
	{
		$this->ser_uid = $ser_uid;
		$this->ser_snombre = $ser_snombre;
	}
}
?>