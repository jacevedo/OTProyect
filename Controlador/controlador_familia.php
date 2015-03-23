<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraFamilia
    {
		private $sql;

		public function agregarFamilia($fam_snombre, $fam_sdescripcion)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO familia VALUES (null, ?, ?);";

				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("ss", $fam_snombre, $fam_sdescripcion);

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

		public function modificarFamilia($fam_snombre, $fam_sdescripcion, $fam_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE familia set fam_snombre = ?, fam_sdescripcion = ? 
																				WHERE fam_uid = ?;";

				$sentencia->bind_param("ssi", $fam_snombre, $fam_sdescripcion, $fam_uid);

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
		
		

		function buscarFamiliaNombre($fam_snombre)
		{
			$conexion = new conexionDB();
			$sql_buscar = "select * from familia where fam_snombre = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('s', $reg_snombre);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($fam_uid, $fam_snombre, $fam_sdescripcion);

			if($sentencia_buscar->fetch() )
			{
				$response["fam_uid"] = $fam_uid;
				$response["fam_snombre"] = $fam_snombre;
				$response["fam_sdescripcion"] = $fam_sdescripcion;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		
		function listarFamilia()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from familia";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($fam_uid, $fam_snombre, $fam_sdescripcion);
				$response["fam_uid"] = $fam_uid;
				$response["fam_snombre"] = $fam_snombre;
				$response["fam_sdescripcion"] = $fam_sdescripcion;
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
		
		public function modificarTipoEstado($fam_uid, $fam_snombre, $fam_sdescripcion)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE familia set fam_snombre = ?, 
												fam_sdescripcion = ? 
												WHERE fam_uid = ?;";
				
				$sentencia->bind_param("ssi", $fam_snombre, $fam_sdescripcion, $fam_uid);
				
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
		
		function eliminarFamilia($fam_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM familia
												WHERE fam_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $fam_uid);
				
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