<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraOTDetalle
    {
		private $sql;

		public function agregarOTDetalle($det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
										$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
										$fk_fal_uid, $fk_ser_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO OTDetalle VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

				$sentencia_agregar = $conexion->prepare($this->SqlQuery);
				$sentencia_agregar->bind_param("ssiisiiii", $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
												$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, $fk_fal_uid
												$fk_ser_uid);

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
		
		function buscarOTDetalle($det_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM OTDetalle WHERE det_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $det_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
										$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
										$fk_fal_uid, $fk_ser_uid);

			if($sentencia_buscar->fetch() )
			{
				$response["det_uid"] = $det_uid;
				$response["det_dfechaComienzo"] = $det_dfechaComienzo;
				$response["det_dfechaTermino"] = $det_dfechaTermino;
				$response["det_ncoordenadaX"] = $det_ncoordenadaX;
				$response["det_ncoordenadaY"] = $det_ncoordenadaY;
				$response["det_sdescripcion"] = $det_sdescripcion;
				$response["fk_res_uid"] = $fk_res_uid;
				$response["fk_pln_uid"] = $fk_pln_uid;
				$response["fk_fal_uid"] = $fk_fal_uid;
				$response["fk_ser_uid"] = $fk_ser_uid;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}


		function listarOTDetalle()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from OTDetalle";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
										$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
										$fk_fal_uid, $fk_ser_uid);
										
				$response["det_uid"] = $det_uid;
				$response["det_dfechaComienzo"] = $det_dfechaComienzo;
				$response["det_dfechaTermino"] = $det_dfechaTermino;
				$response["det_ncoordenadaX"] = $det_ncoordenadaX;
				$response["det_ncoordenadaY"] = $det_ncoordenadaY;
				$response["det_sdescripcion"] = $det_sdescripcion;
				$response["fk_res_uid"] = $fk_res_uid;
				$response["fk_pln_uid"] = $fk_pln_uid;
				$response["fk_fal_uid"] = $fk_fal_uid;
				$response["fk_ser_uid"] = $fk_ser_uid;
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
		
		public function modificarOTDetalle($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
										$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
										$fk_fal_uid, $fk_ser_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE OTDetalle SET det_dfechaComienzo = ?, det_dfechaTermino = ?, 
												det_ncoordenadaX = ?, det_sdescripcion = ?, fk_res_uid = ?, 
												fk_pln_uid = ?, fk_fal_uid = ?, fk_ser_uid = ?
												WHERE det_uid = ?;";

				$sentencia_modificar->bind_param("ssiisiiiii", $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
										$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
										$fk_fal_uid, $fk_ser_uid, $det_uid);

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
		
		function eliminarOTDetalle($det_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM OTDetalle
												WHERE det_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $det_uid);
				
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