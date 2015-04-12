<?php
class InsumoOT
{
	public $insot_uid;
	public $insot_ncantidad;
	public $fk_ins_uid;
	public $fk_det_uid;

	function initClass($insot_uid, $insot_ncantidad, $fk_ins_uid, $fk_det_uid)
	{
		$this->insot_uid = $insot_uid;
		$this->insot_ncantidad = $insot_ncantidad;
		$this->fk_ins_uid = $fk_ins_uid;
		$this->fk_det_uid = $fk_det_uid;
	}
}
?>