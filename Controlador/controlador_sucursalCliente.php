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
                                                        $respuesta["sucCli_uid"] = $sentencia->insert_id;
                                                        $respuesta["motivo"] = "Inserción exitosa";
                                        }
                                        else
                                        {
                                                        $conexion->close();
                                                        $respuesta["sucCli_uid"] = -1;
                                                        $respuesta["motivo"] = "Error en la consulta";
                                        }
                        }
                        catch(Exception $e)
                        {
                                        $respuesta["sucCli_uid"]=-2;
                                        $respuesta["motivo"] = "exception";
                        }

                        return $respuesta;
        }

        public function modificarSucursalCliente($sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid, $sucCli_uid)
        {
                $respuesta = array();
                $conexion = new conexionDB();
                $this->datos = '';

                try
                {
                                $this->SqlQuery = '';
                                $this->SqlQuery = $this->sql = "UPDATE sucursalCliente set sucCli_snombre = ?, sucCli_sdireccion = ?, 
                                                                                                sucCli_sfonoLocal = ?, fk_com_uid = ?, fk_cli_uid = ? 
                                                                                                WHERE sucCli_uid = ?";

                                $sentencia->bind_param("sssiii", $sucCli_snombre, $sucCli_sdireccion, $sucCli_sfonoLocal, $fk_com_uid, $fk_cli_uid, $sucCli_uid);

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

        function buscarSucursalClienteNombre($sucCli_snombre)
        {
            $conexion = new conexionDB();
            // if($this->validarUsuario($idUsuario) )
            // {
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
                            $response["sucCli_snombre"] = "None";
                            //$response["state"] = "Error";
                            $response["fk_reg_uid"] = "Error";
                            //$response["stateConsult"] = "Region no encontrada"
                            return $response;
                    }
            // }
            // else
            // {
                    // $response["sucCli_snombre"] = "None";
                    // $response["state"] = "Error"
                    // $response["fk_reg_uid"] = "Error";
                    // $response["stateConsult"] = "Usuario no valido";
                    // return $response;
            // }
        }
    }
?>