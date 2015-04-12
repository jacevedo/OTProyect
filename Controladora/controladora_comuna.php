<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraComuna
{
	function insertarComuna(Comuna $comuna)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$com_snombre = $comuna->$com_snombre;
		$fk_ciu_uid = $comuna->$fk_ciu_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO comuna VALUES (null, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("si", $com_snombre, $fk_ciu_uid);

			if($sentencia_insertar->execute())
			{
				$conexion->close();
				return $sentencia_insertar->insert_id;
			}
			else
			{
				$conexion->close();
				return false;
			}
		}
		catch(Exception $e)
		{
			return false;
			throw new  $e("Error al ingresar la comuna.");
		}
	}
	
	// function buscarComuna($com_uid)
	// {
		// $conexion = new conexionDB();
		// $sql_buscar = "SELECT * FROM comuna WHERE com_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $com_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($com_uid, $com_snombre, $fk_ciu_uid);

		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["com_uid"] = $com_uid;
			// $respuesta["com_snombre"] = $com_snombre;
			// $respuesta["fk_ciu_uid"] = $fk_ciu_uid;
			// return $respuesta;
		// }
		// else
		// {
			// $respuesta["id"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// return $respuesta;
		// }
	// }
	function listarComuna()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM comuna";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($com_uid, $com_snombre, $fk_ciu_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$comuna = new Comuna();
					$comuna ->initClass($com_uid, $com_snombre, $fk_ciu_uid);
					$this->datos[$indice] = $comuna;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar comunas");
		}
		
		return $this->datos;
	}
	
	function listarComunaPorNombre($com_snombre)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM comuna WHERE com_snombre LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$com_snombre."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($com_uid, $com_snombre, $fk_ciu_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$comuna = new Comuna();
					$comuna ->initClass($com_uid, $com_snombre, $fk_ciu_uid);
					$this->datos[$indice] = $comuna;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar comunas");
		}
		
		return $this->datos;
	}

	function modificarComuna(Comuna $comuna)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$com_snombre = $comuna->$com_snombre;
		$fk_ciu_uid = $comuna->$fk_ciu_uid;
		$com_uid = $comuna->$com_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE comuna SET com_snombre = ?, fk_ciu_uid = ? WHERE com_uid = ?;";

			$sentencia_modificar->bind_param("sii", $com_snombre, $fk_ciu_uid, $com_uid);

			if($sentencia_modificar->execute() )
			{
				if($sentencia_modificar->affected_rows)
				{
						$conexion->close();
						return "Modificado";
				}
				else
				{
						$conexion->close();
						return "error";
				}
			}
			else
			{
				$conexion->close();
				return "error";
			}
		}
		catch(Exception $e)
		{
			return false;
			throw new $e("Error al modificar la comuna.");
		}
	}
	
	function eliminarComuna($com_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM comun
											WHERE com_uid = ?;";
								
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $com_uid);
			
			if($sentencia_eliminar->execute() )
			{
				if($sentencia_eliminar->affected_rows)
				{
					$conexion->close();
					return "Eliminado";
				}
				else
				{
					$conexion->close();
					return "Error";
				}
			}
			else
			{
				$conexion->close();
				return "Error";
			}
		}
		catch(Exception $e)
		{
			return false;
			throw new  $e("Error al eliminar la comuna.");
		}
	}
}
?>