<?php
require_once '../Pojo/clasificacion.php';
require_once '../Controladora/controladora_clasificacion.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de clasificacion
Opciones: 
* 1.- Insertar clasificacion 
  2.- Listar clasificacion
  3.- Modificar clasificacion
  4.- Borrar clasificacion
*/

$jsonRecibido = $_REQUEST["send"];
$data = json_decode($jsonRecibido);
$opcion = $data->{indice};
switch($opcion)
{
	//$sucEmp_uid, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid, $fk_cli_uid
	
	case 1:
		//json Insertar clasificacion {"indice:1, "cla_snombre":"Antonio Varas"}
		$cla_snombre = $data->{'cla_snombre'};
		
		$clasificacion = new clasificacion();
		$controladoraclasificacion = new Controladoraclasificacion();
		$clasificacion->InitClass(0, $cla_snombre);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraclasificacion->agregarclasificacion($clasificacion);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar clasificacion {"indice":2}
		$controladoraclasificacion = new Controladoraclasificacion();
		$arreglo["code"] = 2;
		$arreglo["clasificacion"] =  $controladoraclasificacion->listarclasificacion();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Modificar clasificacion {"indice":3,"cla_snombre":"Arica y Parinacota}
		$cla_snombre = $data->{"cla_snombre"};
		
		$clasificacion = new clasificacion();
		$controladoraclasificacion = new Controladoraclasificacion();
		$clasificacion->InitClass($cla_snombre);
		$arreglo["code"] = 3;
		$arreglo["Modificado"] = $controladoraclasificacion->modificarclasificacion($clasificacion);
		echo(json_encode($arreglo) );
	break;
	case 4: 
		//Json Eliminar clasificacion {"indice":4,"cla_uid":1}
		$cla_uid = $data->{"cla_uid"};
		$controladoraclasificacion = new controladoraclasificacion();
		$arreglo["code"] = 4;
		$arreglo["Eliminado"] = $controladoraclasificacion->eliminarclasificacion($cla_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
