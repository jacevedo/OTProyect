<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraFalla
    {
		private $sql;

		public function agregarFalla($fal_sdescripcion, $fk_cla_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO falla VALUES (null, ?, ?);";

				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("s", $fal_sdescripcion, $fk_cla_uid);

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
		
		function buscarFalla($fal_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM falla WHERE fal_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $fal_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($fal_uid, $fal_sdescripcion, $fk_cla_uid);

			if($sentencia_buscar->fetch() )
			{
				$response["fal_uid"] = $fal_uid;
				$response["fal_sdescripcion"] = $fal_sdescripcion;
				$response["fk_cla_uid"] = $fk_cla_uid;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		
		function listarFalla()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from falla";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($fal_uid, $fal_sdescripcion, $cla_uid);
				$response["fal_uid"] = $fal_uid;
				$response["fal_sdescripcion"] = $fal_sdescripcion;
				$response["cla_uid"] = $cla_uid;
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
		
		public function modificarFalla($fal_uid, $fal_sdescripcion, $fk_cla_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE falla set fal_sdescripcion = ? fk_cla_uid = ? WHERE fal_uid = ?;";

				$sentencia->bind_param("ssi", $fal_sdescripcion, $fk_cla_uid, $fal_uid);

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
		
		function eliminarFalla($fal_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM falla
												WHERE fal_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $fal_uid);
				
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