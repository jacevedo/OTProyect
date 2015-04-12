<?php
class Personal
{
	public $per_uid;
	public $fk_car_uid;
	public $fk_sucEmp_uid;
	public $per_srut;
	public $per_snombre;
	public $per_sapellido;
	public $per_dfecha_ingreso;
	public $per_semail;
	public $per_sfonoLocal;
	public $per_sfonoMovil;
	public $per_sdireccion;

	function initClass($per_uid, $fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion)
	{
		$this->per_uid = $per_uid;
		$this->fk_car_uid = $fk_car_uid;
		$this->fk_sucEmp_uid = $fk_sucEmp_uid;
		$this->per_srut = $per_srut;
		$this->per_snombre = $per_snombre;
		$this->per_sapellido = $per_sapellido;
		$this->per_dfecha_ingreso = $per_dfecha_ingreso;
		$this->per_semail = $per_semail;
		$this->per_sfonoLocal = $per_sfonoLocal;
		$this->per_sfonoMovil = $per_sfonoMovil;
		$this->per_sdireccion = $per_sdireccion;
	}
}
?>