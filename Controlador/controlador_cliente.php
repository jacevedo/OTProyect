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

            public function modificarCliente($cli_srut, $cli_snombre, $cli_sacronimo, $cli_srubro, $cli_uid)
            {
                    $respuesta = array();
                    $conexion = new conexionDB();
                    $this->datos = '';

                    try
                    {
                            $this->SqlQuery = '';
                            $this->SqlQuery = $this->sql = "UPDATE cliente set cli_srut = ?, cli_snombre = ?, cli_sacronimo, 
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

            // function validarUsuario($idUsuario)
            // {
                    // return true;
            // }

            function buscarClienteNombre($reg_snombre)
            {
                    $conexion = new conexionDB();
                    // if($this->validarUsuario($idUsuario) )
                    // {
                            $sql_buscar = "select * from region where reg_snombre = ?";
                            $sentencia_buscar = $conexion->prepare($sql_buscar);
                            $sentencia_buscar->bind_param('s', $reg_snombre);
                            $sentencia_buscar->execute();
                            $sentencia_buscar->bind_result($reg_snombre, $reg_nnumero);

                            if($sentencia_buscar->fetch() )
                            {
                                    $response["regNombre"] = $reg_snombre;
                                    $response["regNumero"] = $reg_nnumero;
                                    return $response;
                            }
                            else
                            {
                                    $response["regNombre"] = "None";
                                    //$response["state"] = "Error";
                                    $response["regNumero"] = "Error";
                                    //$response["stateConsult"] = "Region no encontrada"
                                    return $response;
                            }
                    // }
                    // else
                    // {
                            // $response["regNombre"] = "None";
                            // $response["state"] = "Error"
                            // $response["regNumero"] = "Error";
                            // $response["stateConsult"] = "Usuario no valido";
                            // return $response;
                    // }
            }
    }
?>