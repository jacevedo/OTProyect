<?php
require_once '../Pojo/insumo.php';
require_once '../Controladora/controladora_insumo.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Insumo
Opciones: 
* 1.- Insertar Insumo 
  2.- Listar Insumo
  3.- Buscar Insumo por RUT
  4.- Modificar Insumo
  5.- Borrar Insumo
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
		//json Insertar Insumo {"indice:1, "fam_snombre":"cable rj-45 5m", "ins_sprecio":"5000","ins_ncantidadDisponible":24,"fk_fam_uid":1}
		$ins_snombre = $data->{'ins_snombre'};
		$ins_sprecio = $data->{'ins_sprecio'};
		$ins_ncantidadDisponible = $data->{'ins_ncantidadDisponible'};
		$fk_fam_uid = $data->{'fk_fam_uid'};
		
		$insumo = new Insumo();
		$controladoraInsumo = new ControladoraInsumo();
		$insumo->InitClass(0, $ins_snombre, $ins_sprecio, $ins_ncantidadDisponible, $fk_fam_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraInsumo->insertarInsumo($insumo);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Insumo {"indice":2}
		$controladoraInsumo = new ControladoraInsumo();
		$arreglo["code"] = 2;
		$arreglo["Insumo"] =  $controladoraInsumo->listarInsumo();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar Insumo por Nombre{"indice":3,"ins_snombre":"rj-45"}
		$ins_snombre = $data->{'ins_snombre'};
		
		$controladoraInsumo = new controladoraInsumo();
		$arreglo["code"] = 3;
		$arreglo["listarInsumoPorNombre"] = $controladoraInsumo->listarInsumoPorNombre($ins_snombre)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Modificar Insumo {"indice":4,"ins_snombre":"rj-45","ins_sprecio":5000,"ins_ncantidadDisponible":24,"fk_fam_uid":1,
		//"ins_uid":1}
		$ins_snombre = $data->{'ins_snombre'};
		$ins_sprecio = $data->{'ins_sprecio'};
		$ins_ncantidadDisponible = $data->{'ins_ncantidadDisponible'};
		$fk_fam_uid = $data->{'fk_fam_uid'};
		$ins_uid = $data->{'ins_uid'};
		
		$insumo = new Insumo();
		$controladoraInsumo = new ControladoraInsumo();
		$insumo->InitClass($ins_uid, $ins_snombre, $ins_nprecio, $ins_ncantidadDisponible, $fk_fam_uid);
		$arreglo["code"] = 4;
		$arreglo["Modificado"] = $controladoraInsumo->modificarInsumo($insumo);
		echo(json_encode($arreglo) );
	break;
	case 5: 
		//Json Eliminar Insumo {"indice":5,"ins_uid":1}
		$ins_uid = $data->{"ins_uid"};
		
		$controladoraInsumo = new controladoraInsumo();
		$arreglo["code"] = 5;
		$arreglo["Eliminado"] = $controladoraInsumo->eliminarInsumo($ins_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
