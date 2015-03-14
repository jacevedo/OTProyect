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

                            $sentencia = $conexion->prepare($this->SqlQuery);
                            $sentencia->bind_param("ss", $reg_sregion, $reg_snumero_region);

                            if($sentencia->execute() )
                            {
                                    $conexion->close();
                                    $respuesta["reg_uid"] = $sentencia->insert_id;
                                    $respuesta["motivo"] = "Inserción exitosa";
                            }
                            else
                            {
                                    $conexion->close();
                                    $respuesta["reg_uid"] = -1;
                                    $respuesta["motivo"] = "Error en la consulta";
                            }
                    }
                    catch(Exception $e)
                    {
                            $respuesta["reg_uid"]=-2;
                            $respuesta["motivo"] = "exception";
                    }

                    return $respuesta;
            }

            public function modificarRegion($reg_snombre, $reg_snumero_region, $reg_uid)
            {
                    $respuesta = array();
                    $conexion = new conexionDB();
                    $this->datos = '';

                    try
                    {
                            $this->SqlQuery = '';
                            $this->SqlQuery = $this->sql = "UPDATE region set reg_snombre = ?, reg_snumero_region = ? 
                                                                                            WHERE reg_uid = ?;";

                            $sentencia->bind_param("ssi", $reg_snombre, $reg_snumero_region, $reg_uid);

                            if($sentencia->execute() )
                            {
                                    if($sentencia->affected_rows)
                                    {
                                            $conexion->close();
                                            $respuesta["reg_uid"] = 1;
                                            $respuesta["motivo"] = "Modificación exitosa";
                                    }
                                    else
                                    {
                                            $conexion->close();
                                            $respuesta["reg_uid"] = 1;
                                            $respuesta["motivo"] = "No existe valor que modificar";
                                    }
                            }
                            else
                            {
                                    $conexion->close();
                                    $respuesta["reg_uid"]=-1;
                                    $respuesta["motivo"] = "Error en la consulta";
                            }
                    }
                    catch(Exception $e)
                    {
                            $respuesta["reg_uid"]=-2;
                            $respuesta["motivo"] = "exception";
                    }
                    return $respuesta;
            }

            // function validarUsuario($idUsuario)
            // {
                    // return true;
            // }

            function buscarRegionNombre($reg_snombre)
            {
                    $conexion = new conexionDB();
                    // if($this->validarUsuario($idUsuario) )
                    // {
                            $sql_buscar = "select * from region where reg_snombre = ?";
                            $sentencia_buscar = $conexion->prepare($sql_buscar);
                            $sentencia_buscar->bind_param('s', $reg_snombre);
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
                    // }
                    // else
                    // {
                            // $response["regNombre"] = "None";
                            // $response["state"] = "Error"
                            // $response["reg_snumero_region"] = "Error";
                            // $response["stateConsult"] = "Usuario no valido";
                            // return $response;
                    // }
            }

            function listarRegion()
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