<?php
include_once 'Comun/conexion.php';

class ControladoraPersonal
{
	private $sql;

		public function agregarPersonal($car_uid,$sucEmp_uid,$per_srut, $per_snombre, $per_sapellido, 
										$per_dfecha_ingreso, $per_email,
									    $per_sfonoLocal, $per_sfonoMovil, $per_sdireccion)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO Personal VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				
				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("iissssssss", $car_uid, $sucEmp_uid, $per_srut, $per_snombre, 
										$per_sapellido, $per_dfecha_ingreso, $per_email, $per_sfonoLocal,
										$per_sfonoMovil, $per_sdireccion);
				
				if($sentencia->execute() )
				{
					$conexion->close();
					$respuesta["id"] = $sentencia->insert_id;
					$respuesta["motivo"] = "Inserción exitosa";
				}
				else
				{
					$conexion->close();
					$respuesta["id"] = -1;
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
		
		public function modificarPersonal($per_uid,$car_uid,$sucEmp_uid,$per_srut, $per_snombre,
										$per_sapellido, $per_dfecha_ingreso, $per_semail,
									    $per_sfonoLocal, $per_sfonoMovil, $per_sdireccion)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE Personal 
												SET car_uid = ?, 
													sucEmp_uid = ?,
													per_srut = ?, 
													per_snombre = ?,
													per_sapellido = ?,
													per_dfecha_ingreso = ?,
													per_semail = ?,
													per_sfonoLocal = ?,
													per_sfonoMovil = ?,
													per_sdireccion = ?
												WHERE per_uid = ?;";
				
				$sentencia->bind_param("iissssssssi", $car_uid, $sucEmp_uid, $per_srut, $per_snombre, 
										$per_sapellido, $per_dfecha_ingreso, $per_semail, $per_sfonoLocal,
										$per_sfonoMovil, $per_sdireccion, $per_uid);
				
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
		public function eliminarPersonal($per_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM Personal
												WHERE per_uid = ?;";
				
				$sentencia->bind_param("i", $per_uid);
				
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
		
		function buscarPersonal($per_uid)
		{
			$conexion = new conexionDB();
			$sql_buscar = "select * from Personal where per_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $per_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($per_uid, $car_uid, $sucEmp_uid, $per_srut,
											$per_snombre, $per_sapellido, $per_dfecha_ingreso, 
											$per_semail, $per_sfonoLocal, $per_sfonoMovil, $per_sdireccion);
			
			if($sentencia_buscar->fetch() )
			{
				$response["per_uid"] = $per_uid;
				$response["car_uid"] = $car_uid;
				$response["sucEmp_uid"] = $sucEmp_uid;
				$response["per_srut"] = $per_srut;

				$response["per_snombre"] = $per_snombre;
				$response["per_sapellido"] = $per_sapellido;
				$response["per_dfecha_ingreso"] = $per_dfecha_ingreso;
				$response["per_semail"] = $per_semail;
				$response["per_sfonoLocal"] = $per_sfonoLocal;
				$response["per_sfonoMovil"] = $per_sfonoMovil;
				$response["per_sdireccion"] = $per_sdireccion;
				$response["motivo"] = "Usuario encontrado";

				return $response;
			}
			else
			{
				$response["per_uid"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		function listarPersonal()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_buscar = "select * from Personal";
			$sentencia_listar = $conexion->prepare($sql_buscar);
			$sentencia_listar->bind_param('i', $per_uid);
			$sentencia_listar->execute();
			$contador = 0;
			
			while($sentencia_listar->fetch() )
			{	
				$sentencia_listar->bind_result($per_uid, $car_uid, $sucEmp_uid, $per_srut,
											$per_snombre, $per_sapellido, $per_dfecha_ingreso, 
											$per_semail, $per_sfonoLocal, $per_sfonoMovil, $per_sdireccion);

				$response["per_uid"] = $per_uid;
				$response["car_uid"] = $car_uid;
				$response["sucEmp_uid"] = $sucEmp_uid;
				$response["per_srut"] = $per_srut;

				$response["per_snombre"] = $per_snombre;
				$response["per_sapellido"] = $per_sapellido;
				$response["per_dfecha_ingreso"] = $per_dfecha_ingreso;
				$response["per_semail"] = $per_semail;
				$response["per_sfonoLocal"] = $per_sfonoLocal;
				$response["per_sfonoMovil"] = $per_sfonoMovil;
				$response["per_sdireccion"] = $per_sdireccion;
				$response["motivo"] = "Usuario encontrado";
				$responseArray[$contador] = $response;
				$contador++;
			}
			else
			{
				$response["per_uid"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				$responseArray[0] = $response;
			}

			return $responseArray;
		}
	}
}

?>