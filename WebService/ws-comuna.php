<?php
require_once '../Pojo/comuna.php';
require_once '../Controladora/controladora_comuna.php';

/*
Tiene las opciones de CRUD (Crear, leer, actualizar y borrar) de Comuna
Opciones: 
* 1.- Insertar Comuna 
  2.- Buscar Comuna por Nombre
  3.- Listar Comuna
  4.- Modificar Comuna
  5.- Borrar Comuna
*/

$jsonRecibido = $_REQUEST["send"];
$data = json_decode($jsonRecibido);
$opcion = $data->{indice};
switch($opcion)
{
	case 1:
		//json Insertar Comuna {"indice:1, "com_snombre":"Providencia", "fk_ciu_uid":1}
		$com_snombre = $data->{'com_snombre'};
		$fk_ciu_uid = $data->{'fk_ciu_uid'};
		
		$Comuna = new Comuna();
		$controladoraComuna = new ControladoraComuna();
		$Comuna->InitClass(0, $com_snombre, $fk_ciu_uid);
		$arreglo["code"] = 1;
		$arreglo["idInsertado"] = $controladoraComuna->agregarComuna($Comuna);
		echo(json_encode($arreglo) );
	break;
	case 2:
		//aplicar las busquedas por nombre despues
		//json Buscar Comuna por nombre{"indice":2,"reg_snombre":"Arica Y Parinacota"}
		$com_snombre = $data->{'com_snombre'};
		
		$controladoraComuna = new controladoraComuna();
		$arreglo["code"] = 2;
		$arreglo["buscarComunaNombre"] = $controladoraComuna->buscarComunaNombre($com_snombre)
		echo(json_encode($arreglo) );
	break;
	case 3:
		//json Listar Comuna {"indice":3}
		$controladoraComuna = new ControladoraComuna();
		$arreglo["code"] = 3;
		$arreglo["Comuna"] =  $controladoraComuna->listarComuna();
		echo(json_encode($arreglo) );
	break;
	case 4:
		//json Modificar Comuna {"indice":4,"ciu_snombre":"Arica","fk_ciu_uid":"2","com_uid":1}
		$com_uid = $data->{"com_uid"};
		$com_snombre = $data->{"com_snombre"};
		$fk_ciu_uid = $data->{"fk_ciu_uid"};
		$Comuna = new Comuna();
		$controladoraComuna = new ControladoraComuna();
		$Comuna->InitClass($com_uid, $com_snombre, $fk_ciu_uid);
		$arreglo["code"] = 4;
		$arreglo["Modificado"] = $controladoraComuna->modificarComuna($Comuna);
		echo(json_encode($arreglo) );
	break;
	case 5: 
		//Json Eliminar Comuna {"indice":5,"com_uid":1}
		$com_uid = $data->{"com_uid"};
		$controladoraComuna = new controladoraComuna();
		$arreglo["code"] = 5;
		$arreglo["Eliminado"] = $controladoraComuna->eliminarComuna($com_uid);
		echo(json_encode($arreglo)); 
	break;
}









}
