<?php
	require_once '../Comun/conexionDB.php';
	
	class ControladoraInsumo
	{
		private $sql;

		public function agregarInsumo($ins_snombre, $ins_sprecio, $ins_ncantidadDisponible, $fk_fam_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO insumo VALUES (null, ?, ?, ?, ?);";
				
				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("ssii", $ins_snombre, $ins_sprecio, $ins_ncantidadDisponible, $fk_fam_uid);
				
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
		
		public function modificarInsumo($ins_snombre, $ins_sprecio, $ins_ncantidadDisponible, $fk_fam_uid, $ins_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE insumo set ins_snombre = ?, ins_sprecio = ?, ins_ncantidadDisponible = ?, fk_fam_uid = ?
												WHERE ins_uid = ?;";
				
				$sentencia->bind_param("ssiii", $ins_snombre, $ins_sprecio, $ins_ncantidadDisponible, $fk_fam_uid, $ins_uid);
				
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
		
		function buscarInsumoNombre($ins_snombre)
		{
			$conexion = new conexionDB();
			// if($this->validarUsuario($idUsuario) )
			// {
				$sql_buscar = "select * from insumo where ins_snombre = ?";
				$sentencia_buscar = $conexion->prepare($sql_buscar);
				$sentencia_buscar->bind_param('s', $reg_snombre);
				$sentencia_buscar->execute();
				$sentencia_buscar->bind_result($ins_snombre, $ins_nprecio, $ins_ncantidadDisponible, $fk_fam_uid);
				
				if($sentencia_buscar->fetch() )
				{
					$response["ins_snombre"] = $ins_snombre;
					$response["ins_nprecio"] = $ins_nprecio;
					$response["ins_ncantidadDisponible"] = $ins_ncantidadDisponible;
					$response["fk_fam_uid"] = $fk_fam_uid;
					return $response;
				}
				else
				{
					$response["ins_snombre"] = "None";
					$response["ins_nprecio"] = "Error";
					return $response;
				}
			// }
			// else
			// {
				// $response["ins_snombre"] = "None";
				// $response["fam_sdescripcion"] = "Error";
				// return $response;
			// }
		}
	}
?>