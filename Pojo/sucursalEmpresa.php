<?php
class SucursalEmpresa
{
	
	public $sucEmp_uid;
	public $sucEmp_snombre;
	public $sucEmp_sdireccion;
	public $sucEmp_sfonoLocal;
	public $fk_com_uid;

	function initClass($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid)
	{
		$this->sucEmp_uid = $sucEmp_uid;
		$this->sucEmp_snombre = $sucEmp_snombre;
		$this->sucEmp_sdireccion = $sucEmp_sdireccion;
		$this->sucEmp_sfonoLocal = $sucEmp_sfonoLocal;
		$this->fk_com_uid = $fk_com_uid;
	}
}
?>