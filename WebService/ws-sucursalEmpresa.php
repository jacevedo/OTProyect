<?php
require_once '../Pojo/sucursalEmpresa.php';
require_once '../Controladora/controladora_sucursalEmpresa.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de sucursalEmpresa
Opciones: 
* 1.- Insertar sucursal Empresa 
  2.- Listar sucursal Empresa 
  3.- Listar sucursal Empresa por Nombre
  4.- Buscar sucursal Empresa por Direccion
  5.- Modificar sucursal Empresa
  6.- Borrar sucursal Empresa
*/

$jsonRecibido = $_REQUEST["send"];
$data = json_decode($jsonRecibido);
$opcion = $data->{indice};
switch($opcion)
{	
	case 1:
		//json Insertar sucursalEmpresa {"indice:1, "sucEmp_snombre":"Antonio Varas", "sucEmp_sdireccion":"Avenida Siempre viva 742", 
		// "sucEmp_sfonoLocal":"0221234567", "fk_com_uid":"1", "fk_cli_uid":1}
		$sucEmp_snombre = $data->{'sucEmp_snombre'};
		$sucEmp_sdireccion = $data->{'sucEmp_sdireccion'};
		$sucEmp_sfonoLocal = $data->{'sucEmp_sfonoLocal'};
		$fk_com_uid = $data->{'fk_com_uid'};
		$fk_cli_uid = $data->{'fk_cli_uid'};
		
		
		$sucursalEmpresa = new sucursalEmpresa();
		$controladorasucursalEmpresa = new ControladorasucursalEmpresa();
		$sucursalEmpresa->InitClass(0, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid, $fk_cli_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladorasucursalEmpresa->insertarsucursalEmpresa($sucursalEmpresa);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar sucursalEmpresa {"indice":2}
		$controladorasucursalEmpresa = new ControladorasucursalEmpresa();
		$arreglo["code"] = 2;
		$arreglo["sucursalEmpresa"] =  $controladorasucursalEmpresa->listarsucursalEmpresa();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar sucursalEmpresa por nombre{"indice":3,"sucEmp_snombre":"Avenida Siempre viva 742"}
		$sucEmp_snombre = $data->{'sucEmp_snombre'};
		
		$controladorasucursalEmpresa = new controladorasucursalEmpresa();
		$arreglo["code"] = 3;
		$arreglo["listarSucursalEmpresaPorNombre"] = $controladorasucursalEmpresa->listarSucursalEmpresaPorNombre($sucEmp_snombre)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Listar sucursalEmpresa por direccion{"indice":4,"sucEmp_sdireccion":"Avenida Siempre viva 742"}
		$sucEmp_sdireccion = $data->{'sucEmp_sdireccion'};
		
		$controladorasucursalEmpresa = new controladorasucursalEmpresa();
		$arreglo["code"] = 4;
		$arreglo["listarSucursalEmpresaPorDireccion"] = $controladorasucursalEmpresa->listarSucursalEmpresaPorDireccion($sucEmp_sdireccion)
		echo(json_encode($arreglo) );
	break;

	case 5:
		//json Modificar sucursalEmpresa {"indice:5, "sucEmp_snombre":"Antonio Varas", "sucEmp_sdireccion":"Avenida Siempre viva 742", 
		// "sucEmp_sfonoLocal":"0221234567", "fk_com_uid":"1", "fk_cli_uid":1, "sucEmp_uid":1}
		$sucEmp_uid = $data->{'sucEmp_uid'};
		$sucEmp_snombre = $data->{'sucEmp_snombre'};
		$sucEmp_sdireccion = $data->{'sucEmp_sdireccion'};
		$sucEmp_sfonoLocal = $data->{'sucEmp_sfonoLocal'};
		$fk_com_uid = $data->{'fk_com_uid'};
		$fk_cli_uid = $data->{'fk_cli_uid'};
		
		$sucursalEmpresa = new sucursalEmpresa();
		$controladorasucursalEmpresa = new ControladorasucursalEmpresa();
		$sucursalEmpresa->InitClass($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid, $fk_cli_uid);
		$arreglo["code"] = 5;
		$arreglo["Modificado"] = $controladorasucursalEmpresa->modificarsucursalEmpresa($sucursalEmpresa);
		echo(json_encode($arreglo) );
	break;
	case 6: 
		//Json Eliminar sucursalEmpresa {"indice":6,"sucEmp_uid":1}
		$sucEmp_uid = $data->{"sucEmp_uid"};
		
		$controladorasucursalEmpresa = new controladorasucursalEmpresa();
		$arreglo["code"] = 6;
		$arreglo["Eliminado"] = $controladorasucursalEmpresa->eliminarsucursalEmpresa($sucEmp_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
