<?php
require_once '../Pojo/falla.php';
require_once '../Controladora/controladora_falla.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Falla
Opciones: 
* 1.- Insertar Falla 
  2.- Listar Falla
  3.- Modificar Falla
  4.- Borrar Falla
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
		//json Insertar Falla {"indice:1, "fal_sdescripcion":"Corto Circuito", "fk_cla_uid":"1"}
		$fal_sdescripcion = $data->{'fal_sdescripcion'};
		$fk_cla_uid = $data->{'fk_cla_uid'};
		
		$Falla = new Falla();
		$controladoraFalla = new ControladoraFalla();
		$Falla->InitClass(0, $fal_sdescripcion, $fk_cla_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraFalla->insertarFalla($Falla);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Falla {"indice":2}
		$controladoraFalla = new ControladoraFalla();
		$arreglo["code"] = 2;
		$arreglo["Falla"] =  $controladoraFalla->listarFalla();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Modificar Falla {"indice":3,"fal_sdescripcion":"Corto Circuito","fk_cla_uid":1,"fal_uid":1}
		$fal_sdescripcion = $data->{"fal_sdescripcion"};
		$fk_cla_uid = $data->{"fk_cla_uid"};
		$fal_uid = $data->{"fal_uid"};
		
		$Falla = new Falla();
		$controladoraFalla = new ControladoraFalla();
		$Falla->InitClass($fal_sdescripcion, $fk_cla_uid, $fal_uid);
		$arreglo["code"] = 3;
		$arreglo["Modificado"] = $controladoraFalla->modificarFalla($Falla);
		echo(json_encode($arreglo) );
	break;
	case 4: 
		//Json Eliminar Falla {"indice":4,"fal_uid":1}
		$fal_uid = $data->{"fal_uid"};
		
		$controladoraFalla = new controladoraFalla();
		$arreglo["code"] = 4;
		$arreglo["Eliminado"] = $controladoraFalla->eliminarFalla($fal_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
