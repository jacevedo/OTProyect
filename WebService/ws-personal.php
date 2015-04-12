<?php
require_once '../Pojo/personal.php';
require_once '../Controladora/controladora_personal.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Personal
Opciones: 
* 1.- Insertar Personal 
  2.- Listar Personal
  3.- Buscar Personal por RUT
  4.- Buscar Personal por Nombre
  5.- Modificar Personal
  6.- Borrar Personal
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
		//json Insertar Personal {"indice:1, "per_srut":"1-7", "per_snombre":"Elias", "per_sapellido":"Borquez", "per_dfecha_ingreso":"01-01-2015",
		//"per_email":"correo@appmovil.com","per_sfonoLocal":"555-5555","per_sfonoMovil":"555-5556","per_sdireccion":"Avenida Siempre Viva 746",
		//"fk_car_uid":1,"fk_sucEmp_uid":1}
		$per_srut = $data->{'per_srut'};
		$per_snombre = $data->{'per_snombre'};
		$per_sapellido = $data->{'per_sapellido'}
		$per_dfecha_ingreso = $data->{'per_dfecha_ingreso'}
		$per_email = $data->{'per_email'}
		$per_sfonoLocal = $data->{'per_sfonoLocal'}
		$per_sfonoMovil = $data->{'per_sfonoMovil'}
		$per_sdireccion = $data->{'per_sdireccion'}
		$fk_car_uid = $data->{'fk_car_uid'}
		$fk_sucEmp_uid = $data->{'fk_sucEmp_uid'}
		
		$personal = new Personal();
		$controladoraPersonal = new ControladoraPersonal();
		$personal->InitClass(0, $fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_email, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraPersonal->insertarPersonal($personal);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Personal {"indice":2}
		$controladoraPersonal = new ControladoraPersonal();
		$arreglo["code"] = 2;
		$arreglo["Personal"] =  $controladoraPersonal->listarPersonal();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar Personal por RUT{"indice":3,"per_srut":"1-7"}
		$per_srut = $data->{'per_srut'};
		
		$controladoraPersonal = new controladoraPersonal();
		$arreglo["code"] = 3;
		$arreglo["listarPersonalPorRut"] = $controladoraPersonal->listarPersonalPorRut($per_srut)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Listar Personal por Nombre{"indice":4,"cli_snombre":"ESSO"}
		$cli_snombre = $data->{'cli_snombre'};
		
		$controladoraPersonal = new controladoraPersonal();
		$arreglo["code"] = 4;
		$arreglo["listarPersonalPorNombre"] = $controladoraPersonal->listarPersonalPorNombre($per_snombre, $per_sapellido)
		echo(json_encode($arreglo) );
	break;
	case 5:
		//json Modificar Personal {"indice:5,"per_uid":1, "per_srut":"1-7", "per_snombre":"Elias", "per_sapellido":"Borquez", "per_dfecha_ingreso":"01-01-2015",
		//"per_email":"correo@appmovil.com","per_sfonoLocal":"555-5555","per_sfonoMovil":"555-5556","per_sdireccion":"Avenida Siempre Viva 746",
		//"fk_car_uid":1,"fk_sucEmp_uid":1}
		$per_uid = $data->{'per_uid'};
		$per_srut = $data->{'per_srut'};
		$per_snombre = $data->{'per_snombre'};
		$per_sapellido = $data->{'per_sapellido'}
		$per_dfecha_ingreso = $data->{'per_dfecha_ingreso'}
		$per_email = $data->{'per_email'}
		$per_sfonoLocal = $data->{'per_sfonoLocal'}
		$per_sfonoMovil = $data->{'per_sfonoMovil'}
		$per_sdireccion = $data->{'per_sdireccion'}
		$fk_car_uid = $data->{'fk_car_uid'}
		$fk_sucEmp_uid = $data->{'fk_sucEmp_uid'}
		
		$personal = new Personal();
		$controladoraPersonal = new ControladoraPersonal();
		$personal->InitClass($fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion, $per_uid);
		$arreglo["code"] = 5;
		$arreglo["Modificado"] = $controladoraPersonal->modificarPersonal($personal);
		echo(json_encode($arreglo) );
	break;
	case 6: 
		//Json Eliminar Personal {"indice":6,"per_uid":1}
		$per_uid = $data->{"per_uid"};
		
		$controladoraPersonal = new controladoraPersonal();
		$arreglo["code"] = 6;
		$arreglo["Eliminado"] = $controladoraPersonal->eliminarPersonal($per_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
