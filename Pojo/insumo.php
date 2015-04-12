<?php
class Insumo
{
	public $ins_uid;
	public $ins_snombre;
	public $ins_nprecio;
	public $ins_ncantidadDisponible;
	public $fk_fam_uid;

	function initClass($ins_uid, $ins_snombre, $ins_nprecio, $ins_ncantidadDisponible, $fk_fam_uid)
	{
		$this->ins_uid = $ins_uid;
		$this->ins_snombre = $ins_snombre;
		$this->ins_nprecio = $ins_nprecio;
		$this->ins_ncantidadDisponible = $ins_ncantidadDisponible;
		$this->fk_fam_uid = $fk_fam_uid;
	}
}
?>