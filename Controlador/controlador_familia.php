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
                    // if($this->validarUsuario($idUsuario) )
                    // {
                            $sql_buscar = "select * from familia where fam_snombre = ?";
                            $sentencia_buscar = $conexion->prepare($sql_buscar);
                            $sentencia_buscar->bind_param('s', $reg_snombre);
                            $sentencia_buscar->execute();
                            $sentencia_buscar->bind_result($fam_snombre, $fam_sdescripcion);

                            if($sentencia_buscar->fetch() )
                            {
                                    $response["fam_snombre"] = $fam_snombre;
                                    $response["fam_sdescripcion"] = $fam_sdescripcion;
                                    return $response;
                            }
                            else
                            {
                                    $response["fam_snombre"] = "None";
                                    $response["fam_sdescripcion"] = "Error";
                                    return $response;
                            }
                    // }
                    // else
                    // {
                            // $response["fam_snombre"] = "None";
                            // $response["fam_sdescripcion"] = "Error";
                            // return $response;
                    // }
            }
    }
?>