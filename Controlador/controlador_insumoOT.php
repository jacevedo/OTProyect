<?php
	require_once '../Comun/conexionDB.php';
	
	class ControladoraInsumoOT
	{
		private $sql;

		public function agregarInsumoOT($insot_ncantidad, $fk_ins_uid, $fk_det_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO insumoOT VALUES (null, ?, ?, ?);";
				
				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("iii", $insot_ncantidad, $fk_ins_uid, $fk_det_uid);
				
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
		
		function listarInsumoOT()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from InsumoOT";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($insot_uid, $insot_ncantidad, $fk_ins_uid, $fk_det_uid);
				$response["insot_uid"] = $insot_uid;
				$response["insot_ncantidad"] = $insot_ncantidad;
				$response["fk_ins_uid"] = $fk_ins_uid;
				$response["fk_det_uid"] = $fk_det_uid;
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
		
		public function modificarInsumoOT($insot_uid, $insot_ncantidad, $fk_ins_uid, $fk_det_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE insumoOT set insot_ncantidad = ? fk_ins_uid = ?, 
												fk_det_uid = ?
												WHERE insot_uid = ?;";

				$sentencia->bind_param("ssi", $insot_ncantidad, $fk_ins_uid, $fk_det_uid, $insot_uid);

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
		
		function eliminarInsumoOT($insot_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM insumoOT
												WHERE insot_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $insot_uid);
				
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