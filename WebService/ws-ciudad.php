<?php
require_once '../Pojo/ciudad.php';
require_once '../Controladora/controladora_ciudad';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Ciudad
Opciones: 
* 1.- Insertar Ciudad 
  2.- Buscar Ciudad por ID
  3.- Buscar Ciudad por Nombre
  4.- Listar Ciudad
  5.- Modificar Ciudad
  6.- Borrar Ciudad
*/

$jsonRecibido = $_REQUEST["send"];
$data = json_decode($jsonRecibido);
$opcion = $data->{indice};
switch($opcion)
{
	case 1:
		//json Insertar Ciudad {"indice:1, "Nombre":"Arica", "Region_Asociada":1}
		$ciu_snombre = $data->{'ciu_snombre'};
		$fk_reg_uid = $data->{'fk_reg_uid'};
		
		$Ciudad = new Ciudad();
		$controladoraCiudad = new ControladoraCiudad();
		$Ciudad->InitClass(0, $ciu_snombre, $fk_reg_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraCiudad->agregarCiudad($Ciudad);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Buscar Ciudad por id {"indice":2,"ciu_uid":1}
		$ciu_uid = $data->{'ciu_uid'};
		
		$controladoraCiudad = new controladoraCiudad();
		$arreglo["code"] = 2
		$arreglo["buscarCiudadId"] = $controladoraCiudad->buscarCiudad($ciu_uid);
		echo(json_encode($arreglo) );
	break;
	case 3:
		//aplicar las busquedas por nombre despues
		//json Buscar Ciudad por nombre{"indice":3,"reg_snombre":"Arica Y Parinacota"}
		$reg_snombre = $data->{'reg_snombre'};
		
		$controladoraCiudad = new controladoraCiudad();
		$arreglo["code"] = 3;
		$arreglo["buscarCiudadNombre"] = $controladoraCiudad->buscarCiudadNombre($reg_snombre)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Listar Ciudad {"indice":4}
		$controladoraCiudad = new ControladoraCiudad();
		$arreglo["code"] = 4;
		$arreglo["Ciudad"] =  $controladoraCiudad->listarCiudad();
		echo(json_encode($arreglo) );
	break;
	case 5:
		//json Modificar Ciudad {"indice":5,"ciu_snombre":"Arica","fk_reg_uid":"2","ciu_uid":1}
		$ciu_uid = $data->{"ciu_uid"};
		$ciu_snombre = $data->{"ciu_snombre"};
		$fk_reg_uid = $data->{"fk_reg_uid"};
		$Ciudad = new Ciudad();
		$controladoraCiudad = new ControladoraCiudad();
		$Ciudad->InitClass($ciu_uid, $ciu_snombre, $fk_reg_uid);
		$arreglo["code"] = 2;
		$arreglo["Modificado"] = $controladoraCiudad->modificarCiudad($Ciudad);
		echo(json_encode($arreglo) );
	break;
	case 6: 
		//Json Eliminar Ciudad {"indice":6,"ciu_uid":1}
		$ciu_uid = $data->{"ciu_uid"};
		$controladoraCiudad = new controladoraCiudad();
		$arreglo["code"] = 6;
		$arreglo["Eliminado"] = $controladoraCiudad->eliminarCiudad($ciu_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
