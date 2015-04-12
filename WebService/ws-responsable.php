<?php
require_once '../Pojo/responsable.php';
require_once '../Controladora/controladora_responsable.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Responsable
Opciones: 
* 1.- Insertar Responsable 
  2.- Listar Responsable
  3.- Buscar Responsable por RUT
  4.- Modificar Responsable
  5.- Borrar Responsable
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
		//json Insertar Responsable {"indice:1, "res_snombre":"Son", "res_sapellido":"Goku", "res_sfono":"555-5557",
		//"res_semail":"kamehameha@gmail.com","fk_sucCli_uid":5}
		$res_snombre = $data->{'res_snombre'};
		$res_sapellido = $data->{'res_sapellido'};
		$res_sfono = $data->{'res_sfono'}
		$res_semail = $data->{'res_semail'}
		$fk_sucCli_uid = $data->{'fk_sucCli_uid'}
		
		$responsable = new Responsable();
		$controladoraResponsable = new ControladoraResponsable();
		$responsable->InitClass(0, $res_snombre, $res_sapellido, $res_sfono, $res_semail, $fk_sucCli_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraResponsable->insertarResponsable($responsable);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Responsable {"indice":2}
		$controladoraResponsable = new ControladoraResponsable();
		$arreglo["code"] = 2;
		$arreglo["Responsable"] =  $controladoraResponsable->listarResponsable();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar Responsable por Nombre{"indice":3,"res_snombre":"Son","res_sapellido":"Goku"}
		$per_srut = $data->{'per_srut'};
		
		$controladoraResponsable = new controladoraResponsable();
		$arreglo["code"] = 3;
		$arreglo["listarResponsablePorRut"] = $controladoraResponsable->listarResponsablePorRut($res_snombre, $res_sapellido)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Modificar Responsable {"indice:4, "res_snombre":"Son", "res_sapellido":"Goku", "res_sfono":"555-5557",
		//"res_semail":"kamehameha@gmail.com","fk_sucCli_uid":5,"res_uid":5}
		$res_uid = $data->{'res_uid'};
		$res_snombre = $data->{'res_snombre'};
		$res_sapellido = $data->{'res_sapellido'};
		$res_sfono = $data->{'res_sfono'}
		$res_semail = $data->{'res_semail'}
		$fk_sucCli_uid = $data->{'fk_sucCli_uid'}
		
		$responsable = new Responsable();
		$controladoraResponsable = new ControladoraResponsable();
		$responsable->InitClass($res_semail, $res_snombre, $res_sapellido, $res_sfono, $fk_sucCli_uid, $reg_uid);
		$arreglo["code"] = 4;
		$arreglo["Modificado"] = $controladoraResponsable->modificarResponsable($responsable);
		echo(json_encode($arreglo) );
	break;
	case 5: 
		//Json Eliminar Responsable {"indice":5,"res_uid":1}
		$res_uid = $data->{"res_uid"};
		
		$controladoraResponsable = new controladoraResponsable();
		$arreglo["code"] = 5;
		$arreglo["Eliminado"] = $controladoraResponsable->eliminarResponsable($res_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
