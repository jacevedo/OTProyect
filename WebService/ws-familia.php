<?php
require_once '../Pojo/familia.php';
require_once '../Controladora/controladora_familia.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Familia
Opciones: 
* 1.- Insertar Familia 
  2.- Listar Familia
  3.- Buscar Familia por RUT
  4.- Modificar Familia
  5.- Borrar Familia
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
		//json Insertar Familia {"indice:1, "fam_snombre":"1-7", "fam_sdescripcion":"ESSO"}
		$fam_snombre = $data->{'fam_snombre'};
		$fam_sdescripcion = $data->{'fam_sdescripcion'};
		
		$Familia = new Familia();
		$controladoraFamilia = new ControladoraFamilia();
		$Familia->InitClass(0, $fam_snombre, $fam_sdescripcion);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraFamilia->insertarFamilia($familia);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Familia {"indice":2}
		$controladoraFamilia = new ControladoraFamilia();
		$arreglo["code"] = 2;
		$arreglo["Familia"] =  $controladoraFamilia->listarFamilia();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar Familia por Nombre{"indice":3,"fam_snombre":"redes"}
		$fam_snombre = $data->{'fam_snombre'};
		
		$controladoraFamilia = new controladoraFamilia();
		$arreglo["code"] = 3;
		$arreglo["listarFamiliaPorNombre"] = $controladoraFamilia->listarFamiliaPorNombre($fam_snombre)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Modificar Familia {"indice":4,"fam_snombre":"redes","fam_sdescripcion":"ayuda a establecer conexiones", 
		//"fam_uid":1}
		$fam_snombre = $data->{"fam_snombre"};
		$fam_sdescripcion = $data->{"fam_sdescripcion"};
		$fam_uid = $data->{"fam_uid"};
		
		$Familia = new Familia();
		$controladoraFamilia = new ControladoraFamilia();
		$Familia->InitClass($fam_snombre, $fam_sdescripcion, $fam_uid);
		$arreglo["code"] = 4;
		$arreglo["Modificado"] = $controladoraFamilia->modificarFamilia($Familia);
		echo(json_encode($arreglo) );
	break;
	case 5: 
		//Json Eliminar Familia {"indice":5,"fam_uid":1}
		$fam_uid = $data->{"fam_uid"};
		
		$controladoraFamilia = new controladoraFamilia();
		$arreglo["code"] = 5;
		$arreglo["Eliminado"] = $controladoraFamilia->eliminarFamilia($fam_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
