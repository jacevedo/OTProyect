<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraClasificacion
{
	public function insertarClasificacion(Clasificacion $clasificacion)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$cla_snombre = $clasificacion->$cla_snombre;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO clasificacion VALUES (null, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("s", $cla_snombre);

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
			throw new $e("Error al ingresar el cargo.");
		}
	}
	
	// function buscarClasificacion($cla_uid)
	// {
		// $conexion = new conexionDB();

		// $sql_buscar = "SELECT * FROM clasificacion WHERE cla_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $cla_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($cla_uid, $cla_snombre);

		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["cla_uid"] = $cla_uid;
			// $respuesta["cla_snombre"] = $cla_snombre;
			// return $respuesta;
		// }
		// else
		// {
			// $respuesta["id"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// return $respuesta;
		// }
	// }
	
	function listarClasificacion()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM clasificacion";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($car_uid, $car_snombre);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$clasificacion = new Clasificacion();
					$clasificacion ->initClass($cla_uid, $cla_snombre);
					$this->datos[$indice] = $clasificacion;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar clasificacion");
		}
		
		return $this->datos;
	}

	public function modificarClasificacion(Clasificacion $clasificacion)
	{	
		$conexion = new conexionDB();
		$this->datos = '';

		$cla_snombre = $clasificacion->$cla_snombre;
		$cla_uid = $clasificacion->$cla_uid;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this-> "UPDATE clasificacion SET cla_snombre = ? WHERE cla_uid = ?;";

			$sentencia_modificar->bind_param("si", $cla_snombre, $cla_uid);
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
			throw new $e("Error al modificar la clasificacion.");
		}
	}
	
	function eliminarClasificacion($cla_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "DELETE FROM clasificacion
											WHERE cla_uid = ?;";
									
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $cla_uid);
			
			
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
			throw new  $e("Error al eliminar la clasificacion.");
		}
	}
}
?>