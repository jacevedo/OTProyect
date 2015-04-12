<?php
class Responsable
{
	public $res_uid;
	public $res_snombre;
	public $res_sapellido;
	public $res_sfono;
	public $res_semail;
	public $fk_sucCli_uid;

	function initClass($res_uid, $res_snombre, $res_sapellido, $res_sfono, $res_semail, $fk_sucCli_uid)
	{
		$this->res_uid = $res_uid;
		$this->res_snombre = $res_snombre;
		$this->res_sapellido = $res_sapellido;
		$this->res_sfono = $res_sfono;
		$this->res_semail = $res_semail;
		$this->fk_sucCli_uid = $fk_sucCli_uid;
	}
}
?>