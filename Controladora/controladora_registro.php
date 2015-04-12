<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraContrasena
{
	function insertarContrasena(Contrasena $contrasena)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$fk_per_uid = $contrasena->$fk_per_uid;
		$conusu_scontrasena = $contrasena->$conusu_scontrasena;
		$conusu_dfechaRegistro = $contrasena->$conusu_dfechaRegistro;
		
		$hasher = new PasswordHash(8, false);	
		$contrasenaHasheada = $hasher->HashPassword($conusu_scontrasena);
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO Contrasena VALUES (null, ?, ?, ?);";
			
			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("iss", $fk_per_uid, 
									$contrasenaHasheada, $conusu_dfechaRegistro);
			
			if($sentencia_insertar->execute() )
			{
				$conexion->close();
				return "Password Registrada";
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
			throw new $e("Error al insertar contrasena.");
		}
	}
	
	public function modificarContrasena(Contrasena $contrasena)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$conusu_uid = $contrasena->$conusu_uid;
		$fk_per_uid = $contrasena->$fk_per_uid;
		$conusu_scontrasena = $contrasena->$conusu_scontrasena;
		$conusu_dfechaRegistro = $contrasena->$conusu_dfechaRegistro;
		
		$hasher = new PasswordHash(8, false);	
		$contrasenaHasheada = $hasher->HashPassword($conusu_scontrasena);
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE Contrasena 
											SET fk_per_uid = ?, 
												conusu_scontrasena = ?,
												conusu_dfechaRegistro = ? 
											WHERE conusu_uid = ?;";
			
			$sentencia->bind_param("iiss", $conusu_uid, $fk_per_uid, $conusu_scontrasena, 
										$conusu_dfechaRegistro);
			
			if($sentencia->execute() )
			{
				if($sentencia->affected_rows)
				{
					$conexion->close();
					$respuesta["id"] = 1;
					$respuesta["motivo"] = "Modificación exitosa";
				}
				else
				{
					$conexion->close();
					$respuesta["id"] = 1;
					$respuesta["motivo"] = "No existe valor que modificar";
				}
			}
			else
			{
				$conexion->close();
				$respuesta["id"]=-1;
				$respuesta["motivo"] = "Error en la consulta";
			}
		}
		catch(Exception $e)
		{
			$respuesta["id"]=-2;
			$respuesta["motivo"] = "exception";
		}
		return $respuesta;
	}
	// public function eliminarPersonal($per_uid)
	// {
		// $respuesta = array();
		// $conexion = new conexionDB();
		// $this->datos = '';
		
		// try
		// {
			// $this->SqlQuery = '';
			// $this->SqlQuery = $this->sql = "DELETE FROM Personal
											// WHERE per_uid = ?;";
			
			// $sentencia->bind_param("i", $per_uid);
			
			// if($sentencia->execute() )
			// {
				// if($sentencia->affected_rows)
				// {
					// $conexion->close();
					// $respuesta["id"] = 1;
					// $respuesta["motivo"] = "Modificación exitosa";
				// }
				// else
				// {
					// $conexion->close();
					// $respuesta["id"] = 1;
					// $respuesta["motivo"] = "No existe valor que modificar";
				// }
			// }
			// else
			// {
				// $conexion->close();
				// $respuesta["id"]=-1;
				// $respuesta["motivo"] = "Error en la consulta";
			// }
		// }
		// catch(Exception $e)
		// {
			// $respuesta["id"]=-2;
			// $respuesta["motivo"] = "exception";
		// }
		// return $respuesta;
	// }
	
	// function buscarPersonal($per_uid)
	// {
		// $conexion = new conexionDB();
		// $sql_buscar = "select * from Personal where per_uid = ?";
		// $sentencia_buscar = $conexion->prepare($sql_buscar);
		// $sentencia_buscar->bind_param('i', $per_uid);
		// $sentencia_buscar->execute();
		// $sentencia_buscar->bind_result($per_uid, $car_uid, $sucEmp_uid, $per_srut,
										// $per_snombre, $per_sapellido, $per_dfecha_ingreso, 
										// $per_semail, $per_sfonoLocal, $per_sfonoMovil, $per_sdireccion);
		
		// if($sentencia_buscar->fetch() )
		// {
			// $respuesta["per_uid"] = $per_uid;
			// $respuesta["car_uid"] = $car_uid;
			// $respuesta["sucEmp_uid"] = $sucEmp_uid;
			// $respuesta["per_srut"] = $per_srut;

			// $respuesta["per_snombre"] = $per_snombre;
			// $respuesta["per_sapellido"] = $per_sapellido;
			// $respuesta["per_dfecha_ingreso"] = $per_dfecha_ingreso;
			// $respuesta["per_semail"] = $per_semail;
			// $respuesta["per_sfonoLocal"] = $per_sfonoLocal;
			// $respuesta["per_sfonoMovil"] = $per_sfonoMovil;
			// $respuesta["per_sdireccion"] = $per_sdireccion;
			// $respuesta["motivo"] = "Usuario encontrado";

			// return $respuesta;
		// }
		// else
		// {
			// $respuesta["per_uid"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// return $respuesta;
		// }
	// }
	// function listarPersonal()
	// {
		// $conexion = new conexionDB();
		// $respuestaArray;
		// $sql_buscar = "select * from Personal";
		// $sentencia_listar = $conexion->prepare($sql_buscar);
		// $sentencia_listar->bind_param('i', $per_uid);
		// $sentencia_listar->execute();
		// $contador = 0;
		
		// while($sentencia_listar->fetch() )
		// {	
			// $sentencia_listar->bind_result($per_uid, $car_uid, $sucEmp_uid, $per_srut,
										// $per_snombre, $per_sapellido, $per_dfecha_ingreso, 
										// $per_semail, $per_sfonoLocal, $per_sfonoMovil, $per_sdireccion);

			// $respuesta["per_uid"] = $per_uid;
			// $respuesta["car_uid"] = $car_uid;
			// $respuesta["sucEmp_uid"] = $sucEmp_uid;
			// $respuesta["per_srut"] = $per_srut;

			// $respuesta["per_snombre"] = $per_snombre;
			// $respuesta["per_sapellido"] = $per_sapellido;
			// $respuesta["per_dfecha_ingreso"] = $per_dfecha_ingreso;
			// $respuesta["per_semail"] = $per_semail;
			// $respuesta["per_sfonoLocal"] = $per_sfonoLocal;
			// $respuesta["per_sfonoMovil"] = $per_sfonoMovil;
			// $respuesta["per_sdireccion"] = $per_sdireccion;
			// $respuesta["motivo"] = "Usuario encontrado";
			// $respuestaArray[$contador] = $respuesta;
			// $contador++;
		// }
		// else
		// {
			// $respuesta["per_uid"] = -1;
			// $respuesta["motivo"] = "Error al hacer la consulta";
			// $respuestaArray[0] = $respuesta;
		// }

		// return $respuestaArray;
	// }
}

?>