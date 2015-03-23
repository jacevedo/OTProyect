<?php
	require_once '../Comun/conexionDB.php';
	
	class ControladoraTipoEstado
	{
		private $sql;

		public function agregarTipoEstado($tipest_snombre)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO tipoEstado VALUES (null, ?);";
				
				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("s", $tipest_snombre);
				
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
		
		function buscarTipoEstado($tipest_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM tipoEstado WHERE tipest_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $tipest_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($tipest_uid, $tipest_snombre);

			if($sentencia_buscar->fetch() )
			{
				$response["tipest_uid"] = $tipest_uid;
				$response["tipest_snombre"] = $tipest_snombre;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}

		function listarTipoEstado()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from tipoEstado";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($tipest_uid, $tipest_snombre);
				$response["tipest_uid"] = $tipest_uid;
				$response["tipest_snombre"] = $tipest_snombre;
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
		
		public function modificarTipoEstado($tipest_snombre, $tipest_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE tipoEstado set tipest_snombre = ? WHERE tipest_uid = ?;";
				
				$sentencia->bind_param("si", $tipest_snombre, $tipest_uid);
				
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
		
		function eliminarTipoEstado($tipest_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM tipoEstado
												WHERE tipest_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $tipest_uid);
				
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