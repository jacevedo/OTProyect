<?php
class Ciudad
{
	public $ciu_uid;
	public $ciu_snombre;
	public $fk_reg_uid;

	function initClass($ciu_uid, $ciu_snombre, $fk_reg_uid)
	{
		$this->ciu_uid = $ciu_uid;
		$this->ciu_snombre = $ciu_snombre;
		$this->fk_reg_uid = $fk_reg_uid;
	}
}
?>