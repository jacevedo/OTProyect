<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraCiudad
    {
		private $sql;

		public function agregarCiudad($ciu_snombre, $fk_reg_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
					$this->SqlQuery = '';
					$this->SqlQuery = $this->sql = "INSERT INTO ciudad VALUES (null, ?, ?);";

					$sentencia = $conexion->prepare($this->SqlQuery);
					$sentencia->bind_param("si", $ciu_snombre, $fk_reg_uid);

					if($sentencia->execute() )
					{
							$conexion->close();
							$respuesta["ciu_uid"] = $sentencia->insert_id;
							$respuesta["motivo"] = "Inserción exitosa";
					}
					else
					{
							$conexion->close();
							$respuesta["ciu_uid"] = -1;
							$respuesta["motivo"] = "Error en la consulta";
					}
			}
			catch(Exception $e)
			{
					$respuesta["ciu_uid"]=-2;
					$respuesta["motivo"] = "exception";
			}

			return $respuesta;
		}
		
		function buscarCiudad($ciu_uid)
		{
			$conexion = new conexionDB();
			$sql_buscar = "SELECT * FROM ciudad WHERE ciu_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $ciu_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($reg_snombre, $fk_reg_uid);

			if($sentencia_buscar->fetch() )
			{
				$response["ciu_uid"] = $ciu_uid;
				$response["reg_snombre"] = $reg_snombre;
				$response["fk_reg_uid"] = $fk_reg_uid;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		
		function listarCiudad()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from region";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;
			
			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($ciu_uid, $ciu_snombre, $fk_reg_uid);
				
				$response["ciu_uid"] = $ciu_uid;
				$response["ciu_snombre"] = $ciu_snombre;
				$response["fk_reg_uid"] = $fk_reg_uid;
				$responseArray[$contador] = $response;
				$response["motivo"] = "Ciudad encontrado";
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

		public function modificarCiudad($ciu_snombre, $fk_reg_uid, $ciu_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE ciudad set ciu_snombre = ?, fk_reg_uid = ?
												WHERE ciu_uid = ?";

				$sentencia->bind_param("sii", $ciu_snombre, $fk_reg_uid, $ciu_uid);

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
		
		function eliminarCiudad($ciu_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM ciudad
												WHERE ciu_uid = ?;";
												
				$sentencia->bind_param("i", $ciu_uid);
				
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