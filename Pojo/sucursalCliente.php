<?php
class SucursalCliente
{
	public $car_uid;
	public $car_snombre;
	public $sucCli_sdireccion;
	public $sucCli_sfonoLocal;
	public $fk_com_uid;
	public $fk_cli_uid;

	function initClass($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid)
	{
		$this->sucCli_uid = $sucCli_uid;
		$this->sucCli_snombre = $sucCli_snombre;
		$this->sucCli_sdireccion = $sucCli_sdireccion;
		$this->sucCli_sfonoLocal = $sucCli_sfonoLocal;
		$this->fk_com_uid = $fk_com_uid;
		$this->fk_cli_uid = $fk_cli_uid;
	}
}
?>