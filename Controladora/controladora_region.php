<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraRegion
{
	function insertarRegion(Region $region)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$reg_snombre = $region->$reg_snombre;
		$reg_snumero_region = $region->$reg_snumero_region;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO region VALUES (null, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("ss", $reg_sregion, $reg_snumero_region);

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
			throw new $e("Error al ingresar la región.");
		}
	}
	
	// function buscarRegion($reg_uid)
	// {
		// $conexion = new conexionDB();

		// $sql_buscar = "SELECT * FROM region WHERE reg_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $reg_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($reg_uid, $reg_snombre, $reg_snumero_region);

		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["reg_uid"] = $reg_uid;
			// $respuesta["reg_snombre"] = $reg_snombre;
			// $respuesta["reg_snumero_region"] = $reg_snumero_region;
			// return $respuesta;
		// }
		// else
		// {
			// $respuesta["id"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// return $respuesta;
		// }
	// }
	
	function listarRegion()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM region";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($reg_uid, $reg_snombre, $reg_snumero_region);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$region = new Region();
					$region->initClass($reg_uid, $reg_snombre, $reg_snumero_region);
					$this->datos[$indice] = $region;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar regiones");
		}
		
		return $this->datos;
	}
	
	function listarRegionPorNombre($reg_snombre)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM region WHERE reg_snombre LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$reg_snombre."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($reg_uid, $reg_snombre, $reg_snumero_region);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$region = new Region();
					$region->initClass($reg_uid, $reg_snombre, $reg_snumero_region);
					$this->datos[$indice] = $region;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar regiones");
		}
		
		return $this->datos;
	}

	function listarRegionPorNumero($reg_snumero_region)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM region WHERE reg_snumero_region = ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$reg_snumero_region."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($reg_uid, $reg_snombre, $reg_snumero_region);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$region = new Region();
					$region->initClass($reg_uid, $reg_snombre, $reg_snumero_region);
					$this->datos[$indice] = $region;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar regiones");
		}
		
		return $this->datos;
	}
	
	function modificarRegion(Region $region)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$reg_snombre = $region->$reg_snombre;
		$reg_snumero_region = $region->$reg_snumero_region;
		$reg_uid = $region->$reg_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE region SET reg_snombre = ?, 
															  reg_snumero_region = ? 
											WHERE reg_uid = ?;";

			$sentencia_modificar->bind_param("ssi", $reg_snombre, $reg_snumero_region, $reg_uid);
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
			throw new $e("Error al modificar la region.");
		}
	}
	
	function eliminarRegion($reg_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM region
											WHERE reg_uid = ?;";
			
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $reg_uid);
			
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
			throw new $e("Error al eliminar la region.");
		}
	}
}
?>