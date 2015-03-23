<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraCargo
    {
		private $sql;

		public function agregarCargo($car_snombre)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO cargo VALUES (null, ?);";

				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("s", $car_snombre);

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

		public function modificarCargo($car_snombre, $car_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE cargo set car_snombre = ?
												WHERE car_uid = ?;";

				$sentencia->bind_param("si", $car_snombre, $car_uid);

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


		function buscarCargoNombre($car_snombre)
		{
			$conexion = new conexionDB();
			$sql_buscar = "select * from cargo where car_snombre = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('s', $car_snombre);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($car_snombre);

			if($sentencia_buscar->fetch() )
			{
					$response["regNombre"] = $reg_snombre;
					return $response;
			}
			else
			{
					$response["regNombre"] = "None";
					return $response;
			}
		}
		
		function buscarCargo($car_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM cargo WHERE car_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $car_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($car_snombre);

			if($sentencia_buscar->fetch() )
			{
				$response["car_uid"] = $car_uid;
				$response["car_snombre"] = $car_snombre;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		
		function listarCargo()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from cargo";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
					$sentencia_listar->bind_result($car_uid, $car_snombre);
					$response["car_uid"] = $car_uid;
					$response["car_snombre"] = $car_snombre;
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
		
		function eliminarCargo($car_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM cargo
												WHERE car_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $car_uid);
				
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