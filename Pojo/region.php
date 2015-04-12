<?php
class Region
{
	public $reg_uid;
	public $reg_snombre;
	public $reg_snumero;

	function initClass($reg_uid, $reg_snombre, $reg_snumero)
	{
		$this->reg_uid = $reg_uid;
		$this->reg_snombre = $reg_snombre;
		$this->reg_snumero = $reg_snumero;
	}
}
?>