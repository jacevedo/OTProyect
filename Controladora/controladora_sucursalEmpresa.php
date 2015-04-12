<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraSucursalEmpresa
{
	function insertarSucursalEmpresa(SucursalEmpresa $sucursalEmpresa)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$sucEmp_snombre = $sucursalEmpresa->$sucEmp_snombre;
		$sucEmp_sdireccion = $sucursalEmpresa->$sucEmp_sdireccion;
		$sucEmp_sfonoLocal = $sucursalEmpresa->$sucEmp_sfonoLocal;
		$fk_com_uid = $sucursalEmpresa->$fk_com_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO sucursalEmpresa VALUES (null, ?, ?, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("sssii", $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid);

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
			throw new $e("Error al ingresar la sucursal de la empresa.");
		}
	}
	
	function listarSucursalEmpresa()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM SucursalEmpresa";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$sucursalEmpresa = new SucursalEmpresa();
					$sucursalEmpresa ->initClass($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid);
					$this->datos[$indice] = $sucursalEmpresa;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar la sucursal de la empresa.");
		}
		
		return $this->datos;
	}

	
	function listarSucursalEmpresaPorNombre($sucEmp_snombre)
	{
		$this->SqlQuery = '';
		$this->SqlQuery = "SELECT * FROM sucursalEmpresa WHERE sucEmp_snombre LIKE ?";
		
		$sentencia_listar = $conexion->prepare($this->SqlQuery);
		$nombreParam = "%".$sucEmp_snombre."%";
		$sentencia_listar->bind_param('s', $nombreParam);
		
		if($sentencia_listar->execute() )
		{
			$sentencia_listar->bind_result($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid);
			$indice = 0;
			
			while($sentencia->fetch() )
			{
				$sucursalEmpresa = new SucursalEmpresa();
				$sucursalEmpresa ->initClass($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid);
				$this->datos[$indice] = $sucursalEmpresa;
				$indice++;
			}
		}
		
		$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar las sucursales de la empresa.");
		}
		
		return $this->datos;
	}
	
	function listarSucursalEmpresaPorDireccion($sucEmp_sdireccion)
	{
		$this->SqlQuery = '';
		$this->SqlQuery = "SELECT * FROM sucursalEmpresa WHERE sucEmp_sdireccion = ?";
		
		$sentencia_listar = $conexion->prepare($this->SqlQuery);
		$sentencia_listar->bind_param('s', $sucEmp_sdireccion);
		
		if($sentencia_listar->execute() )
		{
			$sentencia_listar->bind_result($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid);
			$indice = 0;
			
			while($sentencia->fetch() )
			{
				$sucursalEmpresa = new SucursalEmpresa();
				$sucursalEmpresa ->initClass($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid);
				$this->datos[$indice] = $sucursalEmpresa;
				$indice++;
			}
		}
		
		$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar las sucursales de la empresa.");
		}
		
		return $this->datos;
	}
	
	// function buscarSucursalEmpresa($sucEmp_uid)
	// {
		// $conexion = new conexionDB();

		// $sql_buscar = "SELECT * FROM SucursalEmpresa WHERE sucEmp_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $sucEmp_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($sucEmp_uid, $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid);

		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["sucEmp_uid"] = $sucEmp_uid;
			// $respuesta["sucEmp_snombre"] = $sucEmp_snombre;
			// $respuesta["sucEmp_sdireccion"] = $sucEmp_sdireccion;
			// $respuesta["sucEmp_sfonoLocal"] = $sucEmp_sfonoLocal;
			// $respuesta["fk_com_uid"] = $fk_com_uid;
			// return $respuesta;
		// }
		// else
		// {
			// $respuesta["id"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// return $respuesta;
		// }
	// }
	
	function modificarSucursalEmpresa(SucursalEmpresa $sucursalEmpresa)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$sucEmp_snombre = $sucursalEmpresa->$sucEmp_snombre;
		$sucEmp_sdireccion = $sucursalEmpresa->$sucEmp_sdireccion;
		$sucEmp_sfonoLocal = $sucursalEmpresa->$sucEmp_sfonoLocal;
		$fk_com_uid = $sucursalEmpresa->$fk_com_uid;
		$sucEmp_uid = $sucursalEmpresa->$sucEmp_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE sucursalEmpresa set sucEmp_snombre = ?, 
																		sucEmp_sdireccion = ?, 
																		sucEmp_sfonoLocal = ?, 
																		fk_com_uid = ?, 
																		WHERE sucEmp_uid = ?";

			$sentencia_modificar->bind_param("sssiii", $sucEmp_snombre, $sucEmp_sdireccion, $sucEmp_sfonoLocal, $fk_com_uid, $fk_cli_uid, $sucEmp_uid);
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
			throw new $e("Error al modificar la sucursal de la empresa.");
		}
	}
	
	function eliminarSucursalEmpresa($sucEmp_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "DELETE FROM SucursalEmpresa
								WHERE sucEmp_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $sucEmp_uid);
			
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
			throw new  $e("Error al eliminar la sucursal de la empresa.");
		}
	}
}
?>