<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraFalla
    {
            private $sql;

            public function agregarFalla($fal_sdescripcion, $fk_cla_uid)
            {
                    $respuesta = array();
                    $conexion = new conexionDB();
                    $this->datos = '';

                    try
                    {
                            $this->SqlQuery = '';
                            $this->SqlQuery = $this->sql = "INSERT INTO falla VALUES (null, ?, ?);";

                            $sentencia = $conexion->prepare($this->SqlQuery);
                            $sentencia->bind_param("s", $fal_sdescripcion, $fk_cla_uid);

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

            public function modificarClasificacion($fal_sdescripcion, $cla_snombre, $fal_uid)
            {
                    $respuesta = array();
                    $conexion = new conexionDB();
                    $this->datos = '';

                    try
                    {
                            $this->SqlQuery = '';
                            $this->SqlQuery = $this->sql = "UPDATE falla, clasificacion set falla.fal_sdescripcion, clasificacion.cla_snombre = ? WHERE falla.fal_uid = ?;";

                            $sentencia->bind_param("ssi", $fal_sdescripcion, $cla_snombre, $fal_uid);

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