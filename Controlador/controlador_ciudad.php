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
						$respuesta["id"]=-2;
						$respuesta["motivo"] = "exception";
				}

				return $respuesta;
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
									$respuesta["ciu_uid"] = 1;
									$respuesta["motivo"] = "Modificación exitosa";
							}
							else
							{
									$conexion->close();
									$respuesta["ciu_uid"] = 1;
									$respuesta["motivo"] = "No existe valor que modificar";
							}
					}
					else
					{
							$conexion->close();
							$respuesta["ciu_uid"]=-1;
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
		
		function buscarCiudadNombre($ciu_snombre)
		{
			$conexion = new conexionDB();
			// if($this->validarUsuario($idUsuario) )
			// {
				$sql_buscar = "select * from ciudad where ciu_snombre = ?";
				$sentencia_buscar = $conexion->prepare($sql_buscar);
				$sentencia_buscar->bind_param('s', $ciu_snombre);
				$sentencia_buscar->execute();
				$sentencia_buscar->bind_result($ciu_snombre, $fk_reg_uid);
				
				if($sentencia_buscar->fetch() )
				{
					$response["ciu_snombre"] = $ciu_snombre;
					$response["fk_reg_uid"] = $fk_reg_uid;
					return $response;
				}
				else
				{
					$response["ciu_snombre"] = "None";
					//$response["state"] = "Error";
					$response["fk_reg_uid"] = "Error";
					//$response["stateConsult"] = "Region no encontrada"
					return $response;
				}
			// }
			// else
			// {
				// $response["ciu_snombre"] = "None";
				// $response["state"] = "Error"
				// $response["fk_reg_uid"] = "Error";
				// $response["stateConsult"] = "Usuario no valido";
				// return $response;
			// }
		}
		
		function listarCiudad()
		{
			$conexion = new conexionDB();
			$sql_buscar = "select * from region";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($reg_snombre, $reg_snumero_region);
			
			if($sentencia_buscar->fetch() )
			{
				$response["regNombre"] = $reg_snombre;
				$response["reg_snumero_region"] = $reg_snumero_region;
				return $response;
			}
			else
			{
				$response["regNombre"] = "None";
				//$response["state"] = "Error";
				$response["reg_snumero_region"] = "Error";
				//$response["stateConsult"] = "Region no encontrada"
				return $response;
			}
		}
    }
?>