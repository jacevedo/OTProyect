<?php
require_once '../Pojo/cliente.php';
require_once '../Controladora/controladora_cliente.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Cliente
Opciones: 
* 1.- Insertar Cliente 
  2.- Listar Cliente
  3.- Buscar Cliente por RUT
  4.- Buscar Cliente por Nombre
  5.- Modificar Cliente
  6.- Borrar Cliente
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
		//json Insertar Cliente {"indice:1, "cli_srut":"1-7", "cli_snombre":"ESSO", "cli_sacronimo":"ESSO", "cli_srubro":"Combustibles"}
		$cli_srut = $data->{'cli_srut'};
		$cli_snombre = $data->{'cli_snombre'};
		$cli_sacronimo = $data->{'cli_sacronimo'}
		$cli_srubro = $data->{'cli_srubro'}
		
		$Cliente = new Cliente();
		$controladoraCliente = new ControladoraCliente();
		$Cliente->InitClass(0, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraCliente->insertarCliente($Cliente);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//json Listar Cliente {"indice":2}
		$controladoraCliente = new ControladoraCliente();
		$arreglo["code"] = 2;
		$arreglo["Cliente"] =  $controladoraCliente->listarCliente();
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar Cliente por RUT{"indice":3,"cli_srut":"1-7"}
		$cli_srut = $data->{'cli_srut'};
		
		$controladoraCliente = new controladoraCliente();
		$arreglo["code"] = 3;
		$arreglo["listarClientePorRUT"] = $controladoraCliente->listarClientePorRUT($cli_srut)
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Listar Cliente por Nombre{"indice":4,"cli_snombre":"ESSO"}
		$cli_snombre = $data->{'cli_snombre'};
		
		$controladoraCliente = new controladoraCliente();
		$arreglo["code"] = 4;
		$arreglo["listarClientePorNombre"] = $controladoraCliente->listarClientePorNombre($cli_snombre)
		echo(json_encode($arreglo) );
	break;
	case 5:
		//json Modificar Cliente {"indice":5,"cli_srut":"1-7","cli_snombre":"ESSO","cli_sacronimo":"ESSO","cli_srubro":"Combustibles","cli_uid":1}
		$cli_srut = $data->{"cli_srut"};
		$cli_snombre = $data->{"cli_snombre"};
		$cli_sacronimo = $data->{"cli_sacronimo"};
		$cli_srubro = $data->{"cli_srubro"};
		$cli_uid = $data->{"cli_uid"};
		
		$Cliente = new Cliente();
		$controladoraCliente = new ControladoraCliente();
		$Cliente->InitClass( $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro, $cli_uid);
		$arreglo["code"] = 5;
		$arreglo["Modificado"] = $controladoraCliente->modificarCliente($Cliente);
		echo(json_encode($arreglo) );
	break;
	case 6: 
		//Json Eliminar Cliente {"indice":6,"cli_uid":1}
		$cli_uid = $data->{"cli_uid"};
		
		$controladoraCliente = new controladoraCliente();
		$arreglo["code"] = 6;
		$arreglo["Eliminado"] = $controladoraCliente->eliminarCliente($cli_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
