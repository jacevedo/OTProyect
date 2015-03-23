<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraPlanOT
    {
		private $sql;

		public function agregarPlanOT($pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO planOT VALUES (null, ?, ?, ?, ?, ?);";

				$sentencia_agregar = $conexion->prepare($this->SqlQuery);
				$sentencia_agregar->bind_param("sssii", $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid);

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
		
		function buscarPlanOT($pln_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM planOT WHERE pln_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $pln_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($pln_uid, $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid);

			if($sentencia_buscar->fetch() )
			{
				$response["pln_uid"] = $pln_uid;
				$response["pln_dfechaHoraPlan"] = $pln_dfechaHoraPlan;
				$response["pln_sdescripcion"] = $pln_sdescripcion;
				$response["pln_dfechaHoraEmisionIdeal"] = $pln_dfechaHoraEmisionIdeal;
				$response["fk_per_uid"] = $fk_per_uid;
				$response["fk_tipest_uid"] = $fk_tipest_uid;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}

		function listarPlanOT()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from planOT";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($pln_uid, $pln_dfechaHoraPlan, $pln_sdescripcion, 
									$pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid);
									
				$response["pln_uid"] = $pln_uid;
				$response["pln_dfechaHoraPlan"] = $pln_dfechaHoraPlan;
				$response["pln_sdescripcion"] = $pln_sdescripcion;
				$response["pln_dfechaHoraEmisionIdeal"] = $pln_dfechaHoraEmisionIdeal;
				$response["fk_per_uid"] = $fk_per_uid;
				$response["fk_tipest_uid"] = $fk_tipest_uid;
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
		
		public function modificarPlanOT($pln_dfechaHoraPlan, $pln_sdescripcion, 
									$pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid, $pln_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE PlanOT SET pln_dfechaHoraPlan = ?, pln_sdescripcion = ?, 
												pln_dfechaHoraEmisionIdeal = ?, fk_per_uid = ?, 
												fk_tipest_uid = ?	
												WHERE pln_uid = ?;";

				$sentencia_modificar->bind_param("sssiii", $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, 
													$fk_per_uid, $fk_tipest_uid, $pln_uid);

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
		
		function eliminarPlanOT($pln_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM planOT
												WHERE pln_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $pln_uid);
				
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