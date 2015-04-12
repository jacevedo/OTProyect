<?php
class Cargo
{
	public $car_uid;
	public $car_snombre;

	function initClass($car_uid, $car_snombre)
	{
		$this->car_uid = $car_uid;
		$this->car_snombre = $car_snombre;
	}
}
?>