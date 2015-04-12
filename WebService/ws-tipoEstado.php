<?php
require_once '../Pojo/tipoEstado.php';
require_once '../Controladora/controladora_tipoEstado.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de TipoEstado
Opciones: 
* 1.- Insertar TipoEstado 
  2.- Listar TipoEstado
  4.- Modificar TipoEstado
  5.- Borrar TipoEstado
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
		//json Insertar TipoEstado {"indice:1, "tipest_snombre":"Rojo"}
		
		$tipest_snombre = $data->{'tipest_snombre'};
		
		$tipoEstado = new TipoEstado();
		$controladoraTipoEstado = new ControladoraTipoEstado();
		$tipoEstado->InitClass(0, tipest_snombre);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraTipoEstado->insertarTipoEstado($tipoEstado);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar TipoEstado {"indice":2}
		$controladoraTipoEstado = new ControladoraTipoEstado();
		$arreglo["code"] = 2;
		$arreglo["TipoEstado"] =  $controladoraTipoEstado->listarTipoEstado();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Modificar TipoEstado {"indice:3, "tipest_snombre":"Verde", "tipest_uid":1}
		$tipest_snombre = $data->{'tipest_snombre'};
		$tipest_uid = $data->{'tipest_uid'};
		
		$tipoEstado = new TipoEstado();
		$controladoraTipoEstado = new ControladoraTipoEstado();
		$tipoEstado->InitClass($tipest_uid, $tipest_snombre);
		$arreglo["code"] = 3;
		$arreglo["Modificado"] = $controladoraTipoEstado->modificarTipoEstado($tipoEstado);
		echo(json_encode($arreglo) );
	break;
	case 4: 
		//Json Eliminar TipoEstado {"indice":4,"det_uid":1}
		$det_uid = $data->{"det_uid"};
		$controladoraTipoEstado = new controladoraTipoEstado();
		$arreglo["code"] = 4;
		$arreglo["Eliminado"] = $controladoraTipoEstado->eliminarTipoEstado($det_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
