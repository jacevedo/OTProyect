<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraSucursalCliente
{
	function insertarSucursalCliente(SucursalCliente $sucursalCliente)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$sucCli_snombre = $sucursalCliente->$sucCli_snombre;
		$sucCli_sdireccion = $sucursalCliente->$sucCli_sdireccion;
		$sucCli_sfonoLocal = $sucursalCliente->$sucCli_sfonoLocal;
		$fk_com_uid = $sucursalCliente->$fk_com_uid;
		$fk_cli_uid = $sucursalCliente->$fk_cli_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO sucursalCliente VALUES (null, ?, ?, ?, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("sssii", $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);

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
			throw new $e("Error al ingresar la sucursal de la empresa del cliente.");
		}
	}
	
	function listarSucursalCliente()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM sucursalCliente";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$sucursalCliente = new SucursalCliente();
					$sucursalCliente ->initClass($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
					$this->datos[$indice] = $sucursalCliente;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar la sucursal de la empresa del cliente.");
		}
		
		return $this->datos;
	}

	
	function listarSucursalClientePorNombre($sucCli_snombre)
	{
		$this->SqlQuery = '';
		$this->SqlQuery = "SELECT * FROM sucursalCliente WHERE sucCli_snombre LIKE ?";
		
		$sentencia_listar = $conexion->prepare($this->SqlQuery);
		$nombreParam = "%".$sucCli_snombre."%";
		$sentencia_listar->bind_param('s', $nombreParam);
		
		if($sentencia_listar->execute() )
		{
			$sentencia_listar->bind_result($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
			$indice = 0;
			
			while($sentencia->fetch() )
			{
				$sucursalCliente = new SucursalCliente();
				$sucursalCliente ->initClass($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
				$this->datos[$indice] = $sucursalCliente;
				$indice++;
			}
		}
		
		$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar las sucursales de la empresa del cliente.");
		}
		
		return $this->datos;
	}
	
	function listarSucursalEmpresaPorDireccion($sucCli_sdireccion)
	{
		$this->SqlQuery = '';
		$this->SqlQuery = "SELECT * FROM sucursalCliente WHERE sucCli_sdireccion = ?";
		
		$sentencia_listar = $conexion->prepare($this->SqlQuery);
		$sentencia_listar->bind_param('s', $sucCli_sdireccion);
		
		if($sentencia_listar->execute() )
		{
			$sentencia_listar->bind_result($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
			$indice = 0;
			
			while($sentencia->fetch() )
			{
				$sucursalCliente = new SucursalCliente();
				$sucursalCliente ->initClass($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
				$this->datos[$indice] = $sucursalCliente;
				$indice++;
			}
		}
		
		$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar las sucursales de la empresa del cliente.");
		}
		
		return $this->datos;
	}
	
	// function buscarSucursalEmpresa($sucCli_uid)
	// {
		// $conexion = new conexionDB();

		// $sql_buscar = "SELECT * FROM SucursalEmpresa WHERE sucCli_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $sucCli_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($sucCli_uid, $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid);

		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["sucCli_uid"] = $sucCli_uid;
			// $respuesta["sucCli_snombre"] = $sucCli_snombre;
			// $respuesta["sucCli_sdireccion"] = $sucCli_sdireccion;
			// $respuesta["sucCli_sfonoLocal"] = $sucCli_sfonoLocal;
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
	
	function modificarSucursalCliente(SucursalCliente $sucursalCliente)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$sucCli_uid = $sucursalCliente->$sucCli_uid;
		$sucCli_snombre = $sucursalCliente->$sucCli_snombre;
		$sucCli_sdireccion = $sucursalCliente->$sucCli_sdireccion;
		$sucCli_sfonoLocal = $sucursalCliente->$sucCli_sfonoLocal;
		$fk_com_uid = $sucursalCliente->$fk_com_uid;
		$fk_cli_uid = $sucursalCliente->$fk_cli_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE sucursalEmpresa set sucCli_snombre = ?, 
																		sucCli_sdireccion = ?, 
																		sucCli_sfonoLocal = ?, 
																		fk_com_uid = ? , 
																		fk_cli_uid = ?
																		WHERE sucCli_uid = ?";

			$sentencia_modificar->bind_param("sssiii", $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid, $sucCli_uid);
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
			throw new $e("Error al modificar la sucursal de la empresa del cliente.");
		}
	}
	
	function eliminarSucursalCliente($sucCli_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "DELETE FROM sucursalCliente
								WHERE sucCli_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $sucCli_uid);
			
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
			throw new  $e("Error al eliminar la sucursal de la empresa del cliente.");
		}
	}
}
?>