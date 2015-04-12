<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraFalla
{
	function insertarFalla(Falla $falla)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$fal_sdescripcion = $falla->$fal_sdescripcion;
		$fk_cla_uid = $falla->$fk_cla_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO falla VALUES (null, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("si", $fal_sdescripcion, $fk_cla_uid);

			if($sentencia_insertar->execute() )
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
			throw new $e("Error al ingresar la falla.");
		}
	}
	
	// function buscarFalla($fal_uid)
	// {
		// $conexion = new conexionDB();

		// $sql_buscar = "SELECT * FROM falla WHERE fal_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $fal_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($fal_uid, $fal_sdescripcion, $fk_cla_uid);

		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["fal_uid"] = $fal_uid;
			// $respuesta["fal_sdescripcion"] = $fal_sdescripcion;
			// $respuesta["fk_cla_uid"] = $fk_cla_uid;
			// return $respuesta;
		// }
		// else
		// {
			// $respuesta["id"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// return $respuesta;
		// }
	// }
	
	function listarFalla()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM falla";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($fal_uid, $fal_sdescripcion, $cla_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$cargo = new Cargo();
					$cargo ->initClass($fal_uid, $fal_sdescripcion, $cla_uid);
					$this->datos[$indice] = $cargo;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar fallas");
		}
		
		return $this->datos;
	}
	
	function modificarFalla(Falla $falla)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$fal_uid = $falla->$fal_uid;
		$fal_sdescripcion = $falla->$fal_sdescripcion;
		$fk_cla_uid = $falla->$fk_cla_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE falla SET fal_sdescripcion = ?, 
															 fk_cla_uid = ? 
											WHERE fal_uid = ?;";

			$sentencia_modificar->bind_param("sii", $fal_sdescripcion, $fk_cla_uid, $fal_uid);
			$sentencia_modificar = $conexion->prepare($this->SqlQuery);

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
			throw new $e("Error al modificar la falla.");
		}
	}
	
	function eliminarFalla($fal_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM falla
											WHERE fal_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $fal_uid);
			
			if($sentencia_eliminar->execute())
	      	{
	      		if($sentencia_eliminar->affected_rows)
	      		{
		      		$conexion->close();
					return "Eliminado";
				}
				else
				{
					$conexion->close();
					return "Error Eliminando";
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
			return "Error Exception";
			throw new $e("Error al eliminar la falla.");
		}
	}
}
?>