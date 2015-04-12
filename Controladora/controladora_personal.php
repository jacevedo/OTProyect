<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraPersonal
{
	public function insertarPersonal(Personal $personal)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$fk_car_uid = $personal->$fk_car_uid;
		$fk_sucEmp_uid = $personal->$fk_sucEmp_uid;
		$per_srut = $personal->$per_srut;
		$per_snombre = $personal->$per_snombre;
		$per_sapellido = $personal->$per_sapellido;
		$per_dfecha_ingreso = $personal->$per_dfecha_ingreso;
		$per_email = $personal->$per_email;
		$per_sfonoLocal = $personal->$per_sfonoLocal;
		$per_sfonoMovil = $personal->$per_sfonoMovil;
		$per_sdireccion = $personal->$per_sdireccion;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "INSERT INTO Personal VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			
			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("iissssssss", $fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_email, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion);
			
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
			throw new  $e("Error al ingresar el personal.");
		}
	}
	
	function listarPersonal()
	{
		$conexion = new MySqlCon();
		$this->datos = '';
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM Personal";
		   	$sentencia_listar=$conexion->prepare($this->SqlQuery);
        	if($sentencia_listar->execute())
        	{
        		$sentencia_listar->bind_result($per_uid, $fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion);				
				$indice = 0;     

				while($sentencia_listar->fetch())
				{
					$personal = new Personal();
					$personal->initClass($per_uid, $fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion);
					$this->datos[$indice] = $personal;
        			$indice++;
				}
      		}
       		$conexion->close();
    	}
    	catch(Exception $e)
    	{
        	throw new $e("Error al listar personal");
        }
        return $this->datos;
	}
	
	function listarPersonalPorRut($per_srut)
	{
		$conexion = new MySqlCon();
		$this->datos = '';
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM Personal WHERE per_srut = ?";
		   	$sentencia_buscar=$conexion->prepare($this->SqlQuery);
			$sentencia_buscar->bind_param("i",$idArea);
        	if($sentencia_buscar->execute() )
        	{
        		$sentencia_buscar->bind_result($fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion, $per_uid);				
				$indice = 0;     

				while($sentencia->fetch() )
				{
					$personal = new Personal();
					$personal->initClass($fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion, $per_uid);
					$this->datos[$indice] = $personal;
        			$indice++;
				}
      		}
       		$conexion->close();
    	}
    	catch(Exception $e)
    	{
        	throw new $e("Error al listar personal");
        }
        return $this->datos;
	}
	
	function listarPersonalPorNombre($per_snombre, $per_sapellido)
	{
		$conexion = new MySqlCon();
		$this->datos = '';
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM Personal 
							  WHERE per_snombre LIKE ? OR per_sapellido LIKE ?";
							  
		   	$sentencia_buscar=$conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$per_snombre."%";
			$apellidoParam = "%".$per_sapellido."%";
		   	$sentencia_buscar->bind_param("ss",$nombreParam, $apellidoParam);
			
        	if($sentencia_buscar->execute() )
        	{
        		$sentencia_buscar->bind_result($fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion, $per_uid);				
				$indice = 0;     

				while($sentencia->fetch() )
				{
					$personal = new Personal();
					$personal->initClass($fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion, $per_uid);
					$this->datos[$indice] = $personal;
        			$indice++;
				}
      		}
       		$conexion->close();
    	}
    	catch(Exception $e)
    	{
        	throw new $e("Error al listar personal");
        }
        return $this->datos;
	}
	
	function modificarPersonal(Personal $personal)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$per_uid = $personal->$per_uid;
		$fk_car_uid = $personal->$fk_car_uid;
		$fk_sucEmp_uid = $personal->$fk_sucEmp_uid;
		$per_srut = $personal->$per_srut;
		$per_snombre = $personal->$per_snombre;
		$per_sapellido = $personal->$per_sapellido;
		$per_dfecha_ingreso = $personal->$per_dfecha_ingreso;
		$per_email = $personal->$per_email;
		$per_sfonoLocal = $personal->$per_sfonoLocal;
		$per_sfonoMovil = $personal->$per_sfonoMovil;
		$per_sdireccion = $personal->$per_sdireccion;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE Personal 
											SET fk_car_uid = ?, 
												fk_sucEmp_uid = ?,
												per_srut = ?, 
												per_snombre = ?,
												per_sapellido = ?,
												per_dfecha_ingreso = ?,
												per_semail = ?,
												per_sfonoLocal = ?,
												per_sfonoMovil = ?,
												per_sdireccion = ?
											WHERE per_uid = ?;";
			
			$sentencia_modificar = $conexion->prepare($this->SqlQuery);
			$sentencia_modificar->bind_param("iissssssssi", $fk_car_uid, $fk_sucEmp_uid, $per_srut, $per_snombre, 
									$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
									$per_sfonoMovil, $per_sdireccion, $per_uid);
			
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
	        	return "Error";
	        }
		}
		catch(Exception $e)
		{
			return false;
			throw new $e("Error al modificar el personal.");
		}
	}
	
	function eliminarPersonal($per_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM Personal
											WHERE per_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $per_uid);
			
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
			throw new $e("Error al eliminar el personal.");
		}
	}
}

?>