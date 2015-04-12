<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraCliente
{
	private $sql;

	function insertarCliente(Cliente $cliente)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$cli_srut = $cliente->$reg_srut;
		$cli_snombre = $cliente->$cli_snombre;
		$cli_sacronimo = $cliente->$cli_sacronimo;
		$cli_srubro = $cliente->$cli_srubro;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO cliente VALUES (null, ?, ?, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("ssss", $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);

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
			throw new $e("Error al ingresar el cliente.");
		}
	}
	
	function listarCliente()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM cliente";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$cliente = new Cliente();
					$cliente ->initClass($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);
					$this->datos[$indice] = $cliente;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar clientes");
		}
		
		return $this->datos;
	}
	
	function listarClientePorRUT($cli_srut)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM cliente WHERE cli_srut = ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$sentencia_listar->bind_param('s', $cli_srut);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$cliente = new Cliente();
					$cliente ->initClass($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);
					$this->datos[$indice] = $cliente;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar clientes");
		}
		
		return $this->datos;
	}
	
	function listarClientePorNombre($cli_snombre)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM cliente WHERE cli_snombre LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$cli_snombre."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$cliente = new Cliente();
					$cliente ->initClass($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);
					$this->datos[$indice] = $cliente;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar clientes");
		}
		
		return $this->datos;
	}

	function modificarCliente(Cliente $cliente)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$cli_srut = $cliente->$cli_srut;
		$cli_snombre = $cliente->$cli_snombre;
		$cli_sacronimo = $cliente->$cli_sacronimo;
		$cli_srubro = $cliente->$cli_srubro;
		$cli_uid = $cliente->$cli_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "UPDATE cliente SET cli_srut = ?, 
												cli_snombre = ?, 
												cli_sacronimo = ?, 
												cli_srubro = ?
								WHERE cli_uid = ?;";

			$sentencia_modificar = $conexion->prepare($this->SqlQuery);
			$sentencia_modificar->bind_param("ssssi", $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro, $cli_uid);

			if($sentencia->execute())
	      	{
	      		if($sentencia->affected_rows)
	      		{
	      			$conexion->close();
					return "Modificado";
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
			throw new  $e("Error al modificar cliente.");
		}
	}

	function eliminarCliente($cli_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM cliente
											WHERE cli_uid = ?;";
								
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $cli_uid);
			
			if($sentencia->execute() )
	      	{
	      		if($sentencia->affected_rows)
	      		{
		      		$conexion->close();
					return "Eliminado";
				}
				else
				{
					$conexion->close();
					return "Error Eliminando";
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
			return "Error Exception";
			throw new  $e("Error al eliminar cliente.");
		}
	}
}
?>