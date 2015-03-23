<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraRegion
    {
		private $sql;

		public function agregarRegion($reg_snombre, $reg_snumero_region)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO region VALUES (null, ?, ?);";

				$sentencia_agregar = $conexion->prepare($this->SqlQuery);
				$sentencia_agregar->bind_param("ss", $reg_sregion, $reg_snumero_region);

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
		
		function buscarRegion($reg_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM region WHERE reg_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $reg_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($reg_uid, $reg_snombre, $reg_snumero_region);

			if($sentencia_buscar->fetch() )
			{
				$response["reg_uid"] = $reg_uid;
				$response["reg_snombre"] = $reg_snombre;
				$response["reg_snumero_region"] = $reg_snumero_region;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}

		function buscarRegionNombre($reg_snombre)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM region WHERE reg_snombre = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('s', $reg_snombre);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($reg_snombre, $reg_snumero_region);

			if($sentencia_buscar->fetch() )
			{
				$response["reg_snombre"] = $reg_snombre;
				$response["reg_snumero_region"] = $reg_snumero_region;
				return $response;
			}
			else
			{
				$response["reg_snombre"] = "None";
				$response["reg_snumero_region"] = "Error";
				return $response;
			}
		}

		function listarRegion()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from region";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($reg_uid, $reg_snombre, $reg_snumero_region);
				$response["reg_uid"] = $reg_uid;
				$response["reg_snombre"] = $reg_snombre;
				$response["reg_snumero_region"] = $reg_snumero_region;
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
		
		public function modificarRegion($reg_snombre, $reg_snumero_region, $reg_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE region SET reg_snombre = ?, reg_snumero_region = ? 
																				WHERE reg_uid = ?;";

				$sentencia_modificar->bind_param("ssi", $reg_snombre, $reg_snumero_region, $reg_uid);

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
		
		function eliminarRegion($reg_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM region
												WHERE reg_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $reg_uid);
				
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