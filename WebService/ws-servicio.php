<?php
require_once '../Pojo/servicio.php';
require_once '../Controladora/controladora_servicio.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Servicio
Opciones: 
* 1.- Insertar Servicio 
  2.- Listar Servicio
  4.- Modificar Servicio
  5.- Borrar Servicio
*/

$jsonRecibido = $_REQUEST["send"];
$encript = new Encript();
$datos = $encript->validarkey($jsonRecibido);
$data = "";
if(!is_numeric($datos))
{
	$data = json_decode($datos);
	$opcion = $data->{"indice"};
}
else
{
	$opcion = -1;	
}

switch($opcion)
{
	case 1:
		//json Insertar Servicio {"indice:1, "ser_snombre":"Rojo"}
		$ser_snombre = $data->{'ser_snombre'};
		
		$servicio = new Servicio();
		$controladoraServicio = new ControladoraServicio();
		$servicio->InitClass(0, ser_snombre);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraServicio->insertarServicio($servicio);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Servicio {"indice":2}
		$controladoraServicio = new ControladoraServicio();
		$arreglo["code"] = 2;
		$arreglo["Servicio"] =  $controladoraServicio->listarServicio();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Modificar Servicio {"indice:3, "ser_snombre":"Reparacion","ser_uid":1}
		$ser_snombre = $data->{'ser_snombre'};
		$ser_uid = $data->{'ser_uid'};
		
		$servicio = new Servicio();
		$controladoraServicio = new ControladoraServicio();
		$servicio->InitClass($ser_uid, $ser_snombre);
		$arreglo["code"] = 3;
		$arreglo["Modificado"] = $controladoraServicio->modificarServicio($servicio);
		echo(json_encode($arreglo) );
	break;
	case 4: 
		//Json Eliminar Servicio {"indice":4,"ser_uid":1}
		$ser_uid = $data->{"ser_uid"};
		$controladoraServicio = new controladoraServicio();
		$arreglo["code"] = 4;
		$arreglo["Eliminado"] = $controladoraServicio->eliminarServicio($ser_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
