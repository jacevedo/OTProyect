<?php
require_once '../Pojo/planOT.php';
require_once '../Controladora/controladora_PlanOT.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de PlanOT
Opciones: 
* 1.- Insertar PlanOT 
  2.- Listar PlanOT
  3.- Modificar PlanOT
  4.- Borrar PlanOT
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
		//json Insertar PlanOT {"indice:1, "pln_dfechaHoraPlan":"01-01-2015 12:12:12", "pln_sdescripcion":"No tiene internet", 
		//"pln_dfechaHoraEmisionIdeal":05-01-2015 13:13:13, "fk_per_uid":1, "fk_tipest_uid":1}
		$pln_dfechaHoraPlan = $data->{'pln_dfechaHoraPlan'};
		$pln_sdescripcion = $data->{'pln_sdescripcion'};
		$pln_dfechaHoraEmisionIdeal = $data->{'pln_dfechaHoraEmisionIdeal'};
		$reg_snumero_PlanOT = $data->{'reg_snumero_PlanOT'};
		$reg_snumero_PlanOT = $data->{'reg_snumero_PlanOT'};
		
		$planOT = new PlanOT();
		$controladoraPlanOT = new ControladoraPlanOT();
		$planOT->InitClass(0, $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraPlanOT->insertarPlanOT($planOT);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar PlanOT {"indice":2}
		$controladoraPlanOT = new ControladoraPlanOT();
		$arreglo["code"] = 2;
		$arreglo["PlanOT"] =  $controladoraPlanOT->listarPlanOT();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Modificar PlanOT {"indice:3, "pln_uid"=1, "pln_dfechaHoraPlan":"01-01-2015 12:12:12", 
		//"pln_sdescripcion":"No tiene internet", "pln_dfechaHoraEmisionIdeal":05-01-2015 13:13:13, 
		//"fk_per_uid":1, "fk_tipest_uid":1}
		$pln_uid = $data->{'pln_uid'};
		$pln_dfechaHoraPlan = $data->{'pln_dfechaHoraPlan'};
		$pln_sdescripcion = $data->{'pln_sdescripcion'};
		$pln_dfechaHoraEmisionIdeal = $data->{'pln_dfechaHoraEmisionIdeal'};
		$reg_snumero_PlanOT = $data->{'reg_snumero_PlanOT'};
		$reg_snumero_PlanOT = $data->{'reg_snumero_PlanOT'};
		
		$planOT = new PlanOT();
		$controladoraPlanOT = new ControladoraPlanOT();
		$planOT->InitClass($pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, 
												$fk_per_uid, $fk_tipest_uid, $pln_uid);
		$arreglo["code"] = 3;
		$arreglo["Modificado"] = $controladoraPlanOT->modificarPlanOT($planOT);
		echo(json_encode($arreglo) );
	break;
	case 4: 
		//Json Eliminar PlanOT {"indice":4,"pln_uid":1}
		$pln_uid = $data->{"pln_uid"};
		$controladoraPlanOT = new controladoraPlanOT();
		$arreglo["code"] = 4;
		$arreglo["Eliminado"] = $controladoraPlanOT->eliminarPlanOT($pln_uid);
		echo(json_encode($arreglo) ); 
	break;
}









}
