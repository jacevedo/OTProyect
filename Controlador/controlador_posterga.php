<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraPosterga
    {
		private $sql;

		public function agregarPosterga($pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
					$this->SqlQuery = '';
					$this->SqlQuery = $this->sql = "INSERT INTO posterga VALUES (null, ?, ?, ?);";

					$sentencia_agregar = $conexion->prepare($this->SqlQuery);
					$sentencia_agregar->bind_param("ssi", $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);

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

		public function modificarPosterga($pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid, $pos_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE posterga SET pos_dfechaInicio = ?, 
																	pos_dfechaFinal = ?, 
																	fk_per_uid = ?
																	WHERE reg_uid = ?;";

				$sentencia_modificar->bind_param("ssii", $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid, $pos_uid);

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
		
		function buscarPosterga($pos_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM posterga WHERE pos_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $pos_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($pos_uid, $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);

			if($sentencia_buscar->fetch() )
			{
					$response["pos_uid"] = $pos_uid;
					$response["pos_dfechaInicio"] = $pos_dfechaInicio;
					$response["pos_dfechaFinal"] = $pos_dfechaFinal;
					$response["fk_per_uid"] = $fk_per_uid;
					return $response;
			}
			else
			{
					$response["id"] = -1;
					$response["motivo"] = "Error al hacer la consulta";
					return $response;
			}
		}

		function listarPosterga()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from posterga";
			$sentencia_listar = $conexion->prepare($sql_listar);
			//$sentencia_listar->bind_param('i', $reg_uid);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
					$sentencia_listar->bind_result($pos_uid, $pos_dfechaInicio, $pos_dfechaFinal, $fk_per_uid);
					
					$response["pos_uid"] = $pos_uid;
					$response["pos_dfechaInicio"] = $pos_dfechaInicio;
					$response["pos_dfechaFinal"] = $pos_dfechaFinal;
					$response["fk_per_uid"] = $fk_per_uid;
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
		
		function eliminarPosterga($pos_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM posterga
												WHERE pos_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $pos_uid);
				
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