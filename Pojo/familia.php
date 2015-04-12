<?php
class Familia
{
	public $fam_uid;
	public $fam_snombre;
	public $fam_sdescripcion;

	function initClass($fam_uid, $fam_snombre, $fam_sdescripcion)
	{
		$this->fam_uid = $fam_uid;
		$this->fam_snombre = $fam_snombre;
		$this->fam_sdescripcion = $fam_sdescripcion;
	}
}
?>