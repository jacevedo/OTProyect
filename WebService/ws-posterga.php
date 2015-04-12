<?php
require_once '../Pojo/posterga.php';
require_once '../Controladora/controladora_posterga.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Posterga
Opciones: 
* 1.- Insertar Posterga 
  2.- Listar Posterga
  3.- Modificar Posterga
  4.- Borrar Posterga
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
		//json Insertar Posterga {"indice:1, "pos_dfechaInicio":"01-01-2016","pos_dfechaFinal":"09-01-2016","fk_per_uid":1}
		$pos_dfechaInicio = $data->{'pos_dfechaInicio'};
		$pos_dfechaFinal = $data->{'pos_dfechaFinal'};
		$fk_per_uid = $data->{'fk_per_uid'};
		
		$posterga = new Posterga();
		$controladoraPosterga = new ControladoraPosterga();
		$posterga->InitClass(0, $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraPosterga->insertarPosterga($posterga);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Posterga {"indice":2}
		$controladoraPosterga = new ControladoraPosterga();
		$arreglo["code"] = 2;
		$arreglo["Posterga"] =  $controladoraPosterga->listarPosterga();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Modificar Posterga {"indice:1, "pos_dfechaInicio":"01-01-2016","pos_dfechaFinal":"09-01-2016","fk_per_uid":1,
		//							"pos_uid":1}
		$pos_dfechaInicio = $data->{'pos_dfechaInicio'};
		$pos_dfechaFinal = $data->{'pos_dfechaFinal'};
		$fk_per_uid = $data->{'fk_per_uid'};
		$pos_uid = $data->{'pos_uid'};
		
		$posterga = new Posterga();
		$controladoraPosterga = new ControladoraPosterga();
		$posterga->InitClass($pos_uid, $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);
		$arreglo["code"] = 3;
		$arreglo["Modificado"] = $controladoraPosterga->modificarPosterga($posterga);
		echo(json_encode($arreglo) );
	break;
	case 4: 
		//Json Eliminar Posterga {"indice":4,"pos_uid":1}
		$pos_uid = $data->{"pos_uid"};
		$controladoraPosterga = new controladoraPosterga();
		$arreglo["code"] = 4;
		$arreglo["Eliminado"] = $controladoraPosterga->eliminarPosterga($pos_uid);
		echo(json_encode($arreglo) ); 
	break;
}









}
