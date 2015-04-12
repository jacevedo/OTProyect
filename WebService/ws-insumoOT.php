<?php
require_once '../Pojo/InsumoOT.php';
require_once '../Controladora/controladora_InsumoOT.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de InsumoOT
Opciones: 
* 1.- Insertar InsumoOT 
  2.- Listar InsumoOT
  4.- Modificar InsumoOT
  5.- Borrar InsumoOT
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
		//json Insertar InsumoOT {"indice:1, "insot_ncantidad":"2", "fk_ins_uid":1,"fk_det_uid":1}
		$insot_ncantidad = $data->{'insot_ncantidad'};
		$fk_ins_uid = $data->{'fk_ins_uid'};
		$fk_det_uid = $data->{'fk_det_uid'};
		
		$insumoOT = new InsumoOT();
		$controladoraInsumoOT = new ControladoraInsumoOT();
		$insumoOT->InitClass(0, $insot_ncantidad, $fk_ins_uid, $fk_det_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraInsumoOT->insertarInsumoOT($insumoOT);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar InsumoOT {"indice":2}
		$controladoraInsumoOT = new ControladoraInsumoOT();
		$arreglo["code"] = 2;
		$arreglo["InsumoOT"] =  $controladoraInsumoOT->listarInsumoOT();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Modificar InsumoOT {"indice":3,"insot_ncantidad":2,"fk_ins_uid":1,"fk_det_uid":1,"insot_uid":1}
		$insot_ncantidad = $data->{'insot_ncantidad'};
		$fk_ins_uid = $data->{'fk_ins_uid'};
		$fk_det_uid = $data->{'fk_det_uid'};
		$insot_uid = $data->{'insot_uid'};
		
		$insumoOT = new InsumoOT();
		$controladoraInsumoOT = new ControladoraInsumoOT();
		$insumoOT->InitClass($insot_ncantidad, $fk_ins_uid, $fk_det_uid, $insot_uid);
		$arreglo["code"] = 3;
		$arreglo["Modificado"] = $controladoraInsumoOT->modificarInsumoOT($insumoOT);
		echo(json_encode($arreglo) );
	break;
	case 4: 
		//Json Eliminar InsumoOT {"indice":4,"insot_uid":1}
		$insot_uid = $data->{"insot_uid"};
		
		$controladoraInsumoOT = new controladoraInsumoOT();
		$arreglo["code"] = 4
		$arreglo["Eliminado"] = $controladoraInsumoOT->eliminarInsumoOT($insot_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
