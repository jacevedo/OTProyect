<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraCargo
{
	function insertarCargo(Cargo $cargo)
	{
		$conexion = new conexionDB();
		$this->datos = '';

		$car_snombre = $cargo->car_snombre;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO cargo VALUES (null, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("s", $car_snombre);

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

	function listarCargo()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM cargo";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($car_uid, $car_snombre);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$cargo = new Cargo();
					$cargo ->initClass($car_uid, $car_snombre);
					$this->datos[$indice] = $cargo;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar cargos");
		}
		
		return $this->datos;
	}
	
	function listarCargoPorNombre($car_snombre)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM cargo WHERE car_snombre LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$car_snombre."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($car_uid, $car_snombre);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$cargo = new Cargo();
					$cargo ->initClass($car_uid, $car_snombre);
					$this->datos[$indice] = $cargo;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar cargos");
		}
		
		return $this->datos;
	}
	
	function modificarCargo(Cargo $cargo)
	{
		$conexion = new conexionDB();
		$this->datos = '';

		$car_snombre = $cargo->$car_snombre;
		$car_uid = $cargo->$car_uid;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "UPDATE cargo SET car_snombre = ?
								WHERE car_uid = ?;";

			$sentencia_modificar->bind_param("si", $car_snombre, $car_uid);
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
			throw new $e("Error al modificar el cargo.");
		}
	}

	
	
	// function buscarCargo($car_uid)
	// {
		// $conexion = new conexionDB();

		// $sql_buscar = "SELECT * FROM cargo WHERE car_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $car_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($car_snombre);

		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["car_uid"] = $car_uid;
			// $respuesta["car_snombre"] = $car_snombre;
			// return $respuesta;
		// }
		// else
		// {
			// $respuesta["id"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// return $respuesta;
		// }
	// }
	
	
	
	function eliminarCargo($car_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "DELETE FROM cargo
								WHERE car_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $car_uid);
			
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
			throw new  $e("Error al eliminar el cargo.");
		}
	}
}
?>