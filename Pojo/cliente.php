<?php
class Cliente
{
	public $cli_uid;
	public $cli_srut;
	public $cli_snombre;
	public $cli_sacronimo;
	public $cli_srubro;

	function initClass($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro)
	{
		$this->cli_uid = $cli_uid;
		$this->cli_srut = $cli_srut;
		$this->cli_snombre = $cli_snombre;
		$this->cli_sacronimo = $cli_sacronimo;
		$this->cli_srubro = $cli_srubro;
	}
}
?>