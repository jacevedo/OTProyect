<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraComuna
    {
		private $sql;

		public function agregarComuna($com_snombre, $fk_ciu_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO comuna VALUES (null, ?, ?);";

				$sentencia_agregar = $conexion->prepare($this->SqlQuery);
				$sentencia_agregar->bind_param("si", $com_snombre, $fk_ciu_uid);

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
		
		function buscarComuna($com_uid)
		{
			$conexion = new conexionDB();
			$sql_buscar = "SELECT * FROM comuna WHERE com_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $com_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($com_uid, $com_snombre, $fk_ciu_uid);

			if($sentencia_buscar->fetch() )
			{
				$response["com_uid"] = $com_uid;
				$response["com_snombre"] = $com_snombre;
				$response["fk_ciu_uid"] = $fk_ciu_uid;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		
		function listarComuna()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from comuna";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;
			
			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($com_uid, $com_snombre, $fk_ciu_uid);
				
				$response["com_uid"] = $com_uid;
				$response["com_snombre"] = $com_snombre;
				$response["fk_ciu_uid"] = $fk_ciu_uid;
				$responseArray[$contador] = $response;
				$response["motivo"] = "Comuna encontrado";
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

		public function modificarComuna($com_snombre, $ciu_uid, $com_uid)
		{
				$respuesta = array();
				$conexion = new conexionDB();
				$this->datos = '';

				try
				{
						$this->SqlQuery = '';
						$this->SqlQuery = $this->sql = "UPDATE comuna com_snombre = ?, ciu_uid = ? WHERE com_uid = ?;";

						$sentencia->bind_param("sii", $com_snombre, $ciu_uid, $com_uid);

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
		
		function eliminarComuna($com_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM comun
												WHERE com_uid = ?;";
												
				$sentencia->bind_param("i", $com_uid);
				
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
    }
?>