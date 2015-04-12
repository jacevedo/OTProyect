<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraCiudad
{
	function insertarCiudad(Ciudad $ciudad)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$ciu_snombre = $ciudad->$ciu_snombre;
		$fk_reg_uid = $ciudad->$fk_reg_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO ciudad VALUES (null, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("si", $ciu_snombre, $fk_reg_uid);

			if($sentencia_insertar->execute() )
			{
				$conexion->close();
				$sentencia_insertar->insert_id;
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
			throw new $e("Error al ingresar la ciudad.");
		}
	}
	
	function listarCiudad()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM ciudad";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($ciu_uid, $ciu_snombre, $fk_reg_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$ciudad = new ciudad();
					$ciudad ->initClass($ciu_uid, $ciu_snombre, $fk_reg_uid);
					$this->datos[$indice] = $ciudad;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar ciudad");
		}
		
		return $this->datos;
	}
	
	function listarCiudadPorNombre($ciu_snombre)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM ciudad WHERE ciu_snombre LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$ciu_snombre."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($ciu_uid, $ciu_snombre, $fk_reg_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$ciudad = new ciudad();
					$ciudad ->initClass($ciu_uid, $ciu_snombre, $fk_reg_uid);
					$this->datos[$indice] = $ciudad;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar ciudad");
		}
		
		return $this->datos;
	}

	function modificarCiudad(Ciudad $ciudad)
	{
		$conexion = new conexionDB();
		$this->datos = '';

		$ciu_snombre = $ciudad->$ciu_snombre;
		$fk_reg_uid = $ciudad->$fk_reg_uid;
		$ciu_uid = $ciudad->$ciu_uid;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE ciudad SET ciu_snombre = ?, fk_reg_uid = ?
											WHERE ciu_uid = ?";

			$sentencia_modificar->bind_param("sii", $ciu_snombre, $fk_reg_uid, $ciu_uid);

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
			throw new $e("Error al modificar la ciudad.");
		}
	}
	
	function eliminarCiudad($ciu_uid)
	{
		$respuesta = array();
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM ciudad
											WHERE ciu_uid = ?;";
											
			$sentencia_eliminar->bind_param("i", $ciu_uid);
			
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
			throw new  $e("Error al eliminar la ciudad.");
		}
	}
}
?>