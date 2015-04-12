<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraTipoEstado
{
function insertarTipoEstado(TipoEstado $tipoEstado)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$tipest_snombre = $tipoEstado->$tipest_snombre;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO tipoEstado VALUES (null, ?);";
			
			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("s", $tipest_snombre);
			
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
			throw new $e("Error al ingresar el tipo de estado.");
		}
	}
	
	function listarTipoEstado()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM tipoEstado";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($tipest_uid, $tipest_snombre);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$tipoEstado = new TipoEstado();
					$tipoEstado ->initClass($tipest_uid, $tipest_snombre);
					$this->datos[$indice] = $tipoEstado;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar tipos de estados.");
		}
		
		return $this->datos;
	}
	
	
	function modificarTipoEstado(TipoEstado $tipoEstado)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$tipest_snombre = $tipoEstado->$tipoEstado;
		$tipest_uid = $tipoEstado->$tipoEstado;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "UPDATE tipoEstado set tipest_snombre = ? WHERE tipest_uid = ?;";
			
			$sentencia_modificar->bind_param("si", $tipest_snombre, $tipest_uid);
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
			throw new $e("Error al modificar el tipo de estado.");
		}
	}
	
	function eliminarTipoEstado($tipest_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "DELETE FROM tipoEstado
							  WHERE tipest_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $tipest_uid);
			
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
			throw new  $e("Error al eliminar el tipo de estado.");
		}
	}
}
?>