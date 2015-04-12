<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraResponsable
{
	public function insertarResponsable(Responsable $responsable)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$res_snombre = $responsable->$res_snombre;
		$res_sapellido = $responsable->$res_sapellido;
		$res_sfono = $responsable->$res_sfono;
		$res_semail = $responsable->$res_semail;
		$fk_sucCli_uid = $responsable->$fk_sucCli_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO responsable VALUES (null, ?, ?, ?, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("ssssi", $res_snombre, $res_sapellido, $res_sfono, $res_semail, $fk_sucCli_uid);

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
			throw new $e("Error al ingresar el responsable.");
		}
	}
	
	function listarResponsable()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM responsable";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($res_uid, $res_snombre, $res_sapellido, $res_sfono, $res_semail, $fk_sucCli_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$responsable = new Responsable();
					$responsable ->initClass($res_uid, $res_snombre, $res_sapellido, $res_sfono, $res_semail, $fk_sucCli_uid);
					$this->datos[$indice] = $responsable;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar responsables");
		}
		
		return $this->datos;
	}
	
	function listarResponsablePorNombre($res_snombre, $res_sapellido)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM Responsable WHERE res_snombre LIKE ? OR res_sapellido LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$res_snombre."%";
			$apellidoParam = "%".$res_sapellido."%";
			$sentencia_listar->bind_param('ss', $nombreParam, $apellidoParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($res_uid, $res_snombre, $res_sapellido, $res_sfono, $res_semail, $fk_sucCli_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$responsable = new Responsable();
					$responsable ->initClass($res_uid, $res_snombre, $res_sapellido, $res_sfono, $res_semail, $fk_sucCli_uid);
					$this->datos[$indice] = $responsable;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar responsables");
		}
		
		return $this->datos;
	}
	
	function modificarResponsable(Responsable $responsable)
	{
		$respuesta = array();
		$conexion = new conexionDB();
		$this->datos = '';
		
		$res_uid = $responsable->$res_uid;
		$res_semail = $responsable->$res_semail;
		$res_snombre = $responsable->$res_snombre;
		$res_sapellido = $responsable->$res_sapellido;
		$res_sfono = $responsable->$res_sfono;
		$fk_sucCli_uid = $responsable->$fk_sucCli_uid

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "UPDATE responsable 
							   SET res_semail = ?, 
								   res_snombre = ?, 
								   res_sapellido = ?, 
								   res_sfono = ?, 
								   fk_sucCli_uid = ?
							   WHERE res_uid = ?;";

			$sentencia_modificar->bind_param("ssssii", $res_semail, $res_snombre, $res_sapellido, $res_sfono, $fk_sucCli_uid, $reg_uid);
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
			throw new $e("Error al modificar el responsable.");
		}
	}
	
	function eliminarResponsable($res_uid)
	{
		$respuesta = array();
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM responsable
											WHERE res_uid = ?;";
											
			$sentencia_eliminar->bind_param("i", $res_uid);
			
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
			throw new $e("Error al eliminar el responsable.");
		}
	}
}
?>