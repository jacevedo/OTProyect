<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraResponsable
    {
		private $sql;

		public function agregarResponsable($res_snombre, $reg_sapellido, $res_sfono, $res_semail)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO responsable VALUES (null, ?, ?, ?, ?);";

				$sentencia_agregar = $conexion->prepare($this->SqlQuery);
				$sentencia_agregar->bind_param("ssss", $res_snombre, $reg_sapellido, $res_sfono, $res_semail);

				if($sentencia_agregar->execute() )
				{
					$conexion->close();
					$respuesta["id"] = $sentencia_agregar->insert_id;
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
		
		function buscarResponsable($res_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM responsable WHERE res_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $res_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($res_uid, $res_snombre, $reg_sapellido, $res_sfono, $res_semail);

			if($sentencia_buscar->fetch() )
			{
				$response["res_uid"] = $res_uid;
				$response["res_snombre"] = $res_snombre;
				$response["reg_sapellido"] = $reg_sapellido;
				$response["res_sfono"] = $res_sfono;
				$response["res_semail"] = $res_semail;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}

		function buscarResponsableNombre($res_snombre)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM responsable WHERE res_snombre = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('s', $res_snombre);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($res_uid, $res_snombre, $reg_sapellido, $res_sfono, $res_semail);

			if($sentencia_buscar->fetch() )
			{
				$response["res_uid"] = $res_uid;
				$response["res_snombre"] = $res_snombre;
				$response["reg_sapellido"] = $reg_sapellido;
				$response["res_sfono"] = $res_sfono;
				$response["res_semail"] = $res_semail;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}

		function listarResponsable()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from responsable";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($res_uid, $res_snombre, $reg_sapellido, $res_sfono, $res_semail);
				$response["res_uid"] = $res_uid;
				$response["res_snombre"] = $res_snombre;
				$response["reg_sapellido"] = $reg_sapellido;
				$response["res_sfono"] = $res_sfono;
				$response["res_semail"] = $res_semail;
				$responseArray[$contador] = $response;
				$contador++;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				$responseArray[0] = $response;
			}
			
			return $responseArray;
		}
		
		public function modificarResponsable($res_uid, $res_semail, $res_snombre, $reg_sapellido, $res_sfono)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE responsable SET res_semail = ?, res_snombre = ?, 
																		reg_sapellido = ?, 
																		res_sfono = ? 
																		WHERE res_uid = ?;";

				$sentencia_modificar->bind_param("ssssi", $res_semail, $res_snombre, $reg_sapellido, $res_sfono, $reg_uid);

				if($sentencia_modificar->execute() )
				{
					if($sentencia_modificar->affected_rows)
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
						$respuesta["id"] = 1;
						$respuesta["motivo"] = "Eliminación exitoso";
					}
					else
					{
						$conexion->close();
						$respuesta["id"] = -1;
						$respuesta["motivo"] = "No existe valor que eliminar";
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
				$conexion->close();
				$respuesta["id"]=-2;
				$respuesta["motivo"] = "exception";
			}
		}
    }
?>