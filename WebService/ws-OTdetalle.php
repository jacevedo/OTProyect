<?php
require_once '../Pojo/OTDetalle.php';
require_once '../Controladora/controlador_OTDetalle.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de OTDetalle
Opciones: 
* 1.- Insertar OTDetalle 
  2.- Listar OTDetalle
  3.- Buscar OTDetalle por Responsable
  4.- Modificar OTDetalle
  5.- Borrar OTDetalle
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
		//json Insertar OTDetalle {"indice:1, "det_dfechaComienzo":"01-01-2015", "det_dfechaTermino":"02-01-2015"
		//							"det_ncoordenadaX":-33.42,"det_ncoordenadaY":-70.6114,"det_sdescripcion":"No funciono el router", 
		//							"fk_res_uid":1,"fk_pln_uid":2,"fk_fal_uid":2,"fk_ser_uid":1}
		$det_dfechaComienzo = $data->{'det_dfechaComienzo'};
		$det_dfechaTermino = $data->{'det_dfechaTermino'};
		$det_ncoordenadaX = $data->{'det_ncoordenadaX'};
		$det_ncoordenadaY = $data->{'det_ncoordenadaY'};
		$det_sdescripcion = $data->{'det_sdescripcion'};
		$fk_res_uid = $data->{'fk_res_uid'};
		$fk_pln_uid = $data->{'fk_pln_uid'};
		$fk_fal_uid = $data->{'fk_fal_uid'};
		$fk_ser_uid = $data->{'fk_ser_uid'};
		
		$OTDetalle = new OTDetalle();
		$controladoraOTDetalle = new ControladoraOTDetalle();
		$OTDetalle->InitClass(0, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
								$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, $fk_fal_uid
								$fk_ser_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraOTDetalle->insertarOTDetalle($OTDetalle);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar OTDetalle {"indice":2}
		$controladoraOTDetalle = new ControladoraOTDetalle();
		$arreglo["code"] = 2;
		$arreglo["OTDetalle"] =  $controladoraOTDetalle->listarOTDetalle();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar OTDetalle por responsable{"indice":3,"fk_res_uid":"2"}
		$fk_res_uid = $data->{'fk_res_uid'};
		
		$controladoraOTDetalle = new controladoraOTDetalle();
		$arreglo["code"] = 3;
		$arreglo["listarOTDetallePorNombre"] = $controladoraOTDetalle->listarOTDetallePorNombre($fk_res_uid)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Modificar OTDetalle {"indice:4, "det_dfechaComienzo":"01-01-2015", "det_dfechaTermino":"02-01-2015"
		//							"det_ncoordenadaX":-33.42,"det_ncoordenadaY":-70.6114,"det_sdescripcion":"No funciono el router", 
		//							"fk_res_uid":1,"fk_pln_uid":2,"fk_fal_uid":2,"fk_ser_uid":1,"det_uid":1}
		$det_dfechaComienzo = $data->{'det_dfechaComienzo'};
		$det_dfechaTermino = $data->{'det_dfechaTermino'};
		$det_ncoordenadaX = $data->{'det_ncoordenadaX'};
		$det_ncoordenadaY = $data->{'det_ncoordenadaY'};
		$det_sdescripcion = $data->{'det_sdescripcion'};
		$fk_res_uid = $data->{'fk_res_uid'};
		$fk_pln_uid = $data->{'fk_pln_uid'};
		$fk_fal_uid = $data->{'fk_fal_uid'};
		$fk_ser_uid = $data->{'fk_ser_uid'};
		$det_uid = $data->{'det_uid'};
		
		$OTDetalle = new OTDetalle();
		$controladoraOTDetalle = new ControladoraOTDetalle();
		$OTDetalle->InitClass($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
									$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
									$fk_fal_uid, $fk_ser_uid);
		$arreglo["code"] = 4;
		$arreglo["Modificado"] = $controladoraOTDetalle->modificarOTDetalle($OTDetalle);
		echo(json_encode($arreglo) );
	break;
	case 5: 
		//Json Eliminar OTDetalle {"indice":5,"det_uid":1}
		$det_uid = $data->{"det_uid"};
		$controladoraOTDetalle = new controladoraOTDetalle();
		$arreglo["code"] = 5;
		$arreglo["Eliminado"] = $controladoraOTDetalle->eliminarOTDetalle($det_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
