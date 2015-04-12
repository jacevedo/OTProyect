<?php
require_once '../Pojo/region.php';
require_once '../Controladora/controladora_region.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Region
Opciones: 
* 1.- Insertar Region 
  2.- Listar Region
  3.- Buscar Region por Nombre
  4.- Buscar Region por Numero
  5.- Modificar Region
  6.- Borrar Region
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
		//json Insertar Region {"indice:1, "Nombre":"Arica y Parinacota", "Numero Region":"XV"}
		$reg_snombre = $data->{'reg_snombre'};
		$reg_snumero_region = $data->{'reg_snumero_region'};
		
		$region = new Region();
		$controladoraRegion = new ControladoraRegion();
		$region->InitClass(0, $reg_snombre, $reg_snumero_region);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraRegion->insertarRegion($region);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Region {"indice":2}
		$controladoraRegion = new ControladoraRegion();
		$arreglo["code"] = 2;
		$arreglo["region"] =  $controladoraRegion->listarRegion();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar Region por nombre{"indice":3,"reg_snombre":"Arica Y Parinacota"}
		$reg_snombre = $data->{'reg_snombre'};
		
		$controladoraRegion = new controladoraRegion();
		$arreglo["code"] = 3;
		$arreglo["listarRegionPorNombre"] = $controladoraRegion->listarRegionPorNombre($reg_snombre)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Listar Region por numero de region{"indice":4,"reg_snumero_region":"XV"}
		$reg_snumero_region = $data->{'reg_snumero_region'};
		
		$controladoraRegion = new controladoraRegion();
		$arreglo["code"] = 4;
		$arreglo["listarRegionPorNumero"] = $controladoraRegion->listarRegionPorNumero($reg_snumero_region)
		echo(json_encode($arreglo) );
	break;
	case 5:
		//json Modificar Region {"indice":5,"reg_snombre":"Arica y Parinacota","reg_snumero_region":"I","reg_uid":1}
		$reg_uid = $data->{"reg_uid"};
		$reg_snombre = $data->{"reg_snombre"};
		$reg_snumero_region = $data->{"reg_snumero_region"};
		
		$region = new Region();
		$controladoraRegion = new ControladoraRegion();
		$region->InitClass($reg_snombre, $reg_snumero_region, $reg_uid);
		$arreglo["code"] = 5;
		$arreglo["Modificado"] = $controladoraRegion->modificarRegion($region);
		echo(json_encode($arreglo) );
	break;
	case 6: 
		//Json Eliminar Region {"indice":6,"reg_uid":1}
		$reg_uid = $data->{"reg_uid"};
		$controladoraRegion = new controladoraRegion();
		$arreglo["code"] = 6;
		$arreglo["Eliminado"] = $controladoraRegion->eliminarRegion($reg_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
