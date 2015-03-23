<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraClasificacion
    {
		private $sql;

		public function agregarClasificacion($cla_snombre)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO clasificacion VALUES (null, ?);";

				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("s", $cla_snombre);

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
		
		function buscarClasificacion($cla_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM clasificacion WHERE cla_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $cla_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($cla_uid, $cla_snombre);

			if($sentencia_buscar->fetch() )
			{
				$response["cla_uid"] = $cla_uid;
				$response["cla_snombre"] = $cla_snombre;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		
		function listarClasificacion()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from clasificacion";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($cla_uid, $cla_snombre);
				$response["cla_uid"] = $cla_uid;
				$response["cla_snombre"] = $cla_snombre;
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

		public function modificarClasificacion($cla_snombre, $cla_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE clasificacion set cla_snombre = ? WHERE cla_uid = ?;";

				$sentencia->bind_param("si", $cla_snombre, $cla_uid);

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
		
		function eliminarClasificacion($cla_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM clasificacion
												WHERE cla_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $cla_uid);
				
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