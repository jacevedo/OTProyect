<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraServicio
{
	function insertarServicio(Servicio $servicio)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$ser_snombre = $servicio->$ser_snombre;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO servicio VALUES (null, ?);";
			
			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("s", $ser_snombre);
			
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
			throw new $e("Error al ingresar el servicio.");
		}
	}
	
	function listarServicio()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM servicio";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($ser_uid, $ser_snombre);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$servicio = new Servicio();
					$servicio ->initClass($ser_uid, $ser_snombre);
					$this->datos[$indice] = $servicio;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar el servicio.");
		}
		
		return $this->datos;
	}
	
	// function buscarServicio($ser_uid)
	// {
		// $conexion = new conexionDB();

		// $sql_buscar = "SELECT * FROM servicio WHERE ser_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $ser_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($ser_uid, $ser_snombre);

		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["ser_uid"] = $ser_uid;
			// $respuesta["ser_snombre"] = $ser_snombre;
			// return $respuesta;
		// }
		// else
		// {
			// $respuesta["id"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// return $respuesta;
		// }
	// }
	
	function modificarServicio(Servicio $servicio)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$ser_snombre = $servicio->$ser_snombre;
		$ser_uid = $servicio->$ser_uid;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "UPDATE servicio set ser_snombre = ? WHERE ser_uid = ?;";
			
			$sentencia_modificar->bind_param("si", $ser_snombre, $ser_uid);
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
			throw new $e("Error al modificar el servicio.");
		}
	}
	
	function eliminarServicio($ser_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "DELETE FROM servicio
							  WHERE ser_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $ser_uid);
			
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
			throw new $e("Error al eliminar el servicio.");
		}
	}
}
?>