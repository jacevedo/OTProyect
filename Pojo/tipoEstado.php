<?php
class TipoEstado
{
	public $tipest_uid;
	public $tipest_snombre;
	public $reg_snumero;

	function initClass($tipest_uid, $tipest_snombre)
	{
		$this->tipest_uid = $tipest_uid;
		$this->tipest_snombre = $tipest_snombre;
	}
}
?>