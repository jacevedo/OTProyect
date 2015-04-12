<?php
require_once '../Pojo/cargo.php':
require_once '../Controladora/controladora_cargo.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de cargo
Opciones: 
* 1.- Insertar cargo 
  2.- Listar cargo
  3.- Listar cargo por nombre
  3.- Modificar cargo
  4.- Borrar cargo
*/

$jsonRecibido = $_REQUEST["send"];
$data = json_decode($jsonRecibido);
$opcion = $data->{indice};
switch($opcion)
{	
	case 1:
		//json Insertar cargo {"indice:1, "car_snombre":"Gerente Tecnico"}
		$car_snombre = $data->{'car_snombre'};
		
		$cargo = new Cargo();
		$controladoracargo = new Controladoracargo();
		$cargo->InitClass(0, $car_snombre);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoracargo->insertarcargo($cargo);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar cargo {"indice":2}
		$controladoracargo = new Controladoracargo();
		$arreglo["code"] = 2;
		$arreglo["cargo"] =  $controladoracargo->listarcargo();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar cargo por nombre{"indice": 3, "car_snombre":"Gerente Tecnico"}
		$car_snombre = $data->{'car_snombre'};
		
		$cargo = new Cargo();
		$arreglo["code"] = 3;
		$arreglo["cargo"] =  $controladoracargo->listarCargoPorNombre($car_snombre);
		echo(json_encode($arreglo) );
		break;
	case 4:
		//json Modificar cargo {"indice":3, "car_uid":1,"car_snombre":"Arica y Parinacota}
		$car_uid = $data->{"car_uid"};
		$car_snombre = $data->{"car_snombre"};
		
		$cargo = new Cargo();
		$controladoracargo = new Controladoracargo();
		$cargo->InitClass($car_uid, $car_snombre);
		$arreglo["code"] = 3;
		$arreglo["Modificado"] = $controladoracargo->modificarcargo($cargo);
		echo(json_encode($arreglo) );
	break;
	case 5: 
		//Json Eliminar cargo {"indice":4,"cla_uid":1}
		$cla_uid = $data->{"cla_uid"};
		$controladoracargo = new controladoracargo();
		$arreglo["code"] = 4;
		$arreglo["Eliminado"] = $controladoracargo->eliminarcargo($cla_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
