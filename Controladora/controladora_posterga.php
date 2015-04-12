<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraPosterga
{
	function insertarPosterga(Posterga $posterga)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$pos_dfechaInicio = $posterga->$pos_dfechaInicio;
		$pos_dfechaFinal = $posterga->$pos_dfechaFinal;
		$fk_per_uid = $posterga->$fk_per_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO posterga VALUES (null, ?, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("ssi", $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);

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
			throw new $e("Error al ingresar la posterga.");
		}
	}
	
	
	
	function listarPosterga()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM posterga";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($pos_uid, $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$posterga = new Posterga();
					$posterga ->initClass($pos_uid, $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);
					$this->datos[$indice] = $posterga;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar las postergas");
		}
	}
	
	
	// function buscarPosterga($pos_uid)
	// {
		// $conexion = new conexionDB();

		// $sql_buscar = "SELECT * FROM posterga WHERE pos_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $pos_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($pos_uid, $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);

		// if($sentencia_buscar->fetch() )
		// {
				// $respuesta["pos_uid"] = $pos_uid;
				// $respuesta["pos_dfechaInicio"] = $pos_dfechaInicio;
				// $respuesta["pos_dfechaFinal"] = $pos_dfechaFinal;
				// $respuesta["fk_per_uid"] = $fk_per_uid;
				// return $respuesta;
		// }
		// else
		// {
				// $respuesta["id"] = -1;
				// $respuesta["motivo"] = "Error al hacer la consulta";
				// return $respuesta;
		// }
	// }

	function modificarPosterga(Posterga $posterga)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$pos_dfechaInicio = $posterga->$pos_dfechaInicio;
		$pos_dfechaFinal = $posterga->$pos_dfechaFinal;
		$fk_per_uid = $posterga->$fk_per_uid;
		$pos_uid = $posterga->$pos_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE posterga SET pos_dfechaInicio = ?, 
																pos_dfechaFinal = ?, 
																fk_per_uid = ?
																WHERE reg_uid = ?;";

			$sentencia_modificar->bind_param("ssii", $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid, $pos_uid);
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
			throw new $e("Error al modificar las postergas.");
		}
	}
	
	function eliminarPosterga($pos_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM posterga
											WHERE pos_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);								
			$sentencia_eliminar->bind_param("i", $pos_uid);
			
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
			throw new  $e("Error al eliminar las postergas.");
		}
	}
}
?>