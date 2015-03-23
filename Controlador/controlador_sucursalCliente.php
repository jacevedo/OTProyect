<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraSucursalCliente
    {
        private $sql;

        public function agregarSucursalCliente($sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid)
        {
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO sucursalCliente VALUES (null, ?, ?, ?, ?, ?);";

				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("sssii", $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);

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
		
		function buscarSucursalClienteNombre($sucCli_snombre)
        {
            $conexion = new conexionDB();
			$sql_buscar = "select * from sucursalCliente where sucCli_snombre = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('s', $sucCli_snombre);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($sucCli_snombre, $fk_reg_uid);

			if($sentencia_buscar->fetch() )
			{
				$response["sucCli_snombre"] = $sucCli_snombre;
				$response["fk_reg_uid"] = $fk_reg_uid;
				return $response;
			}
			else
			{
				$response["id"] = "None";
				$response["fk_reg_uid"] = "Error";
				return $response;
			}
        }
		
		function buscarSucursalCliente($sucCli_uid)
		{
			$conexion = new conexionDB();

			$sql_buscar = "SELECT * FROM SucursalCliente WHERE sucCli_uid = ?";
			$sentencia_buscar = $conexion->prepare($sql_buscar);
			$sentencia_buscar->bind_param('i', $sucCli_uid);
			$sentencia_buscar->execute();
			$sentencia_buscar->bind_result($sucCli_uid, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);

			if($sentencia_buscar->fetch() )
			{
				$response["sucCli_uid"] = $sucCli_uid;
				$response["sucCli_sdireccion"] = $sucCli_sdireccion;
				$response["sucCli_sfonoLocal"] = $sucCli_sfonoLocal;
				$response["fk_com_uid"] = $fk_com_uid;
				$response["fk_cli_uid"] = $fk_cli_uid;
				return $response;
			}
			else
			{
				$response["id"] = -1;
				$response["motivo"] = "Error al hacer la consulta";
				return $response;
			}
		}
		
		function listarSucursalCliente()
		{
			$conexion = new conexionDB();
			$responseArray;
			$sql_listar = "select * from SucursalCliente";
			$sentencia_listar = $conexion->prepare($sql_listar);
			$sentencia_listar->execute();
			$contador = 0;

			while($sentencia_listar->fetch() )
			{
				$sentencia_listar->bind_result($sucCli_uid, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid);
				$response["sucCli_uid"] = $sucCli_uid;
				$response["sucCli_sdireccion"] = $sucCli_sdireccion;
				$response["sucCli_sfonoLocal"] = $sucCli_sfonoLocal;
				$response["fk_com_uid"] = $fk_com_uid;
				$response["fk_cli_uid"] = $fk_cli_uid;
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

        public function modificarSucursalCliente($sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid, $sucCli_uid)
        {
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';

			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE sucursalCliente set sucCli_snombre = ?, 
																			sucCli_sdireccion = ?, 
																			sucCli_sfonoLocal = ?, 
																			fk_com_uid = ?, 
																			fk_cli_uid = ? 
																			WHERE sucCli_uid = ?";

				$sentencia->bind_param("sssiii", $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid, $sucCli_uid);

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
		
		function eliminarSucursalCliente($sucCli_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "DELETE FROM SucursalCliente
												WHERE sucCli_uid = ?;";
												
				$sentencia_eliminar->bind_param("i", $sucCli_uid);
				
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