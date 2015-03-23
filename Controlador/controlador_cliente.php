<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraCliente
    {
		private $sql;

		public function agregarCliente($reg_srut, $cli_snombre, $cli_sacronimo, $cli_srubro)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO cliente VALUES (null, ?, ?, ?, ?);";

				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("ssss", $reg_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);

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
		
		function buscarCliente($cli_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM cliente WHERE cli_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $cli_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);

			if($sentencia_buscar->fetch() )
			{
				$response["cli_uid"] = $cli_uid;
				$response["cli_srut"] = $cli_srut;
				$response["cli_snombre"] = $cli_snombre;
				$response["cli_sacronimo"] = $cli_sacronimo;
				$response["cli_srubro"] = $cli_srubro;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		
		function listarCliente()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from cliente";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($cli_uid, $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro);
				$response["cli_uid"] = $cli_uid;
				$response["cli_srut"] = $cli_srut;
				$response["cli_snombre"] = $cli_snombre;
				$response["cli_sacronimo"] = $cli_sacronimo;
				$response["cli_srubro"] = $cli_srubro;
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

		public function modificarCliente($cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro, $cli_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE cliente set cli_srut = ?, 
																	cli_snombre = ?, 
																	cli_sacronimo, 
																	cli_srubro = ?
												WHERE cli_uid = ?;";

				$sentencia->bind_param("ssssi", $cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro, $cli_uid);

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

		function eliminarCliente($cli_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM cliente
												WHERE cli_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $cli_uid);
				
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