<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraFamilia
{
	function insertarFamilia(Familia $familia)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$fam_snombre = $familia->$fam_snombre;
		$fam_sdescripcion = $familia->$fam_sdescripcion;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO familia VALUES (null, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("ss", $fam_snombre, $fam_sdescripcion);

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
			throw new $e("Error al ingresar la familia.");
		}
	}
	
	
	
	function listarFamilia()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM familia";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($fam_uid, $fam_snombre, $fam_sdescripcion);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$familia = new Familia();
					$familia ->initClass($fam_uid, $fam_snombre, $fam_sdescripcion);
					$this->datos[$indice] = $familia;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar familias");
		}
		
		return $this->datos;
	}
	
	function listarFamiliaPorNombre($fam_snombre)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM familia WHERE fam_snombre LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$fam_snombre."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($fam_uid, $fam_snombre, $fam_sdescripcion);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$familia = new Familia();
					$familia ->initClass($fam_uid, $fam_snombre, $fam_sdescripcion);
					$this->datos[$indice] = $familia;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar familias");
		}
		
		return $this->datos;
	}

	function modificarFamilia(Familia $familia)
	{	
		$conexion = new conexionDB();
		$this->datos = '';
		
		$fam_snombre = $familia->$fam_snombre;
		$fam_sdescripcion = $familia->$fam_sdescripcion;
		$fam_uid = $familia->$fam_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE familia set fam_snombre = ?, fam_sdescripcion = ? 
																			WHERE fam_uid = ?;";

			$sentencia_modificar->bind_param("ssi", $fam_snombre, $fam_sdescripcion, $fam_uid);
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
			throw new $e("Error al modificar la familia.");
		}
	}
	
	function eliminarFamilia($fam_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM familia
											WHERE fam_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $fam_uid);
			
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
			throw new $e("Error al eliminar la familia.");
		}
	}
}
?>