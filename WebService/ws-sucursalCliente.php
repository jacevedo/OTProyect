<?php
require_once '../Pojo/sucursalCliente.php';
require_once '../Controladora/controladora_sucursalCliente.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de sucursalCliente
Opciones: 
* 1.- Insertar sucursal Cliente
  2.- Listar sucursal Cliente
  3.- Listar sucursal Clientepor Direccion
  4.- Buscar sucursal Clientepor ID
  5.- Modificar sucursal Empresa
  6.- Borrar sucursal Empresa
*/

$jsonRecibido = $_REQUEST["send"];
$data = json_decode($jsonRecibido);
$opcion = $data->{indice};
switch($opcion)
{	
	case 1:
		//json Insertar sucursalCliente {"indice:1, "sucCli_snombre":"Aquel Tipo", "sucCli_sdireccion":"Avenida Siempre viva 742", 
		// "sucCli_sfonoLocal":"0221234567", "fk_com_uid":"1", "fk_cli_uid":1}
		$sucCli_snombre = $data->{'sucCli_snombre'};
		$sucCli_sdireccion = $data->{'sucCli_sdireccion'};
		$sucCli_sfonoLocal = $data->{'sucCli_sfonoLocal'};
		$fk_com_uid = $data->{'fk_com_uid'};
		$fk_cli_uid = $data->{'fk_cli_uid'};
		
		
		$sucursalCliente = new sucursalCliente();
		$controladorasucursalCliente = new ControladorasucursalCliente();
		$sucursalCliente->InitClass(0, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladorasucursalCliente->insertarsucursalCliente($sucursalCliente);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar sucursalCliente {"indice":2}
		$controladorasucursalCliente = new ControladorasucursalCliente();
		$arreglo["code"] = 2;
		$arreglo["listarSucursalCliente"] =  $controladorasucursalCliente->listarSucursalCliente();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar sucursalCliente por nombre{"indice":3,"sucCli_snombre":"Avenida Siempre viva 742"}
		$sucCli_snombre = $data->{'sucCli_snombre'};
		
		$controladorasucursalCliente = new controladorasucursalCliente();
		$arreglo["code"] = 3;
		$arreglo["listarSucursalClientePorNombre"] = $controladorasucursalCliente->listarSucursalClientePorNombre($sucCli_snombre)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Listar sucursalCliente por direccion{"indice":4,"sucCli_sdireccion":"Avenida Siempre viva 742"}
		$sucCli_sdireccion = $data->{'sucCli_sdireccion'};
		
		$controladorasucursalCliente = new controladorasucursalCliente();
		$arreglo["code"] = 4;
		$arreglo["listarSucursalEmpresaPorDireccion"] = $controladorasucursalCliente->listarSucursalEmpresaPorDireccion($sucCli_sdireccion)
		echo(json_encode($arreglo) );
	break;

	case 5:
		//json Modificar sucursalCliente {"indice:5, "sucCli_snombre":"Antonio Varas", "sucCli_sdireccion":"Avenida Siempre viva 742", 
		// "sucCli_sfonoLocal":"0221234567", "fk_com_uid":"1", "fk_cli_uid":1, "sucCli_uid":1}
		$sucCli_uid = $data->{'sucCli_uid'};
		$sucCli_snombre = $data->{'sucCli_snombre'};
		$sucCli_sdireccion = $data->{'sucCli_sdireccion'};
		$sucCli_sfonoLocal = $data->{'sucCli_sfonoLocal'};
		$fk_com_uid = $data->{'fk_com_uid'};
		$fk_cli_uid = $data->{'fk_cli_uid'};
		
		$sucursalCliente = new sucursalCliente();
		$controladorasucursalCliente = new ControladorasucursalCliente();
		$sucursalCliente->InitClass($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
		$arreglo["code"] = 5;
		$arreglo["Modificado"] = $controladorasucursalCliente->modificarSucursalCliente($sucursalCliente);
		echo(json_encode($arreglo) );
	break;
	case 6: 
		//Json Eliminar sucursalCliente {"indice":6,"sucCli_uid":1}
		$sucCli_uid = $data->{"sucCli_uid"};
		
		$controladorasucursalCliente = new controladorasucursalCliente();
		$arreglo["code"] = 6;
		$arreglo["Eliminado"] = $controladorasucursalCliente->eliminarsucursalCliente($sucCli_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
