<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraInsumo
{
	function insertarInsumo(Insumo $insumo)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$ins_snombre = $insumo->$ins_snombre;
		$ins_sprecio = $insumo->$ins_sprecio;
		$ins_ncantidadDisponible = $insumo->$ins_ncantidadDisponible;
		$fk_fam_uid = $insumo->$fk_fam_uid;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO insumo VALUES (null, ?, ?, ?, ?);";
			
			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("ssii", $ins_snombre, $ins_sprecio, $ins_ncantidadDisponible, $fk_fam_uid);
			
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
			throw new $e("Error al ingresar el insumo.");
		}
	}
	
	function listarInsumo()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM insumo";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($ins_uid, $ins_snombre, $ins_nprecio, $ins_ncantidadDisponible, $fk_fam_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$insumo = new Insumo();
					$insumo ->initClass($ins_uid, $ins_snombre, $ins_nprecio, $ins_ncantidadDisponible, $fk_fam_uid);
					$this->datos[$indice] = $insumo;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar insumos");
		}
		
		return $this->datos;
	}
	
	function listarInsumoPorNombre($ins_snombre)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM insumo WHERE ins_snombre LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$ins_snombre."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($ins_uid, $ins_snombre, $ins_nprecio, $ins_ncantidadDisponible, $fk_fam_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$insumo = new Insumo();
					$insumo ->initClass($ins_uid, $ins_snombre, $ins_nprecio, $ins_ncantidadDisponible, $fk_fam_uid);
					$this->datos[$indice] = $insumo;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar insumos");
		}
		
		return $this->datos;
	}
	
	function modificarInsumo(Insumo $insumo)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$ins_snombre = $insumo->$ins_snombre;
		$ins_sprecio = $insumo->$ins_sprecio;
		$ins_ncantidadDisponible = $insumo->$ins_ncantidadDisponible;
		$fk_fam_uid = $insumo->$fk_fam_uid;
		$ins_uid = $insumo->$ins_uid;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE insumo SET ins_snombre = ?, 
															  ins_sprecio = ?, 
															  ins_ncantidadDisponible = ?, 
															  fk_fam_uid = ?
											WHERE ins_uid = ?;";
			
			$sentencia->bind_param("ssiii", $ins_snombre, $ins_sprecio, $ins_ncantidadDisponible, $fk_fam_uid, $ins_uid);
			
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
			throw new $e("Error al modificar el insumo.");
		}
	}
	
	function eliminarInsumo($ins_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM insumo
											WHERE ins_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $ins_uid);
			
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
			throw new  $e("Error al eliminar el insumo.");
		}
	}
}
?>