<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraComuna
    {
            private $sql;

            public function agregarComuna($com_snombre, $fk_ciu_uid)
            {
                    $respuesta = array();
                    $conexion = new conexionDB();
                    $this->datos = '';

                    try
                    {
                            $this->SqlQuery = '';
                            $this->SqlQuery = $this->sql = "INSERT INTO comuna VALUES (null, ?, ?);";

                            $sentencia = $conexion->prepare($this->SqlQuery);
                            $sentencia->bind_param("si", $com_snombre, $fk_ciu_uid);

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

            public function modificarComuna($com_snombre, $ciu_snombre, $reg_snombre, $reg_snumero_region, $com_uid)
            {
                    $respuesta = array();
                    $conexion = new conexionDB();
                    $this->datos = '';

                    try
                    {
                            $this->SqlQuery = '';
                            $this->SqlQuery = $this->sql = "UPDATE comuna, ciudad, region set comuna.com_snombre = ?, 
                                                                                            ciudad.ciu_snombre = ?, region.reg_snombre = ?, 
                                                                                            region.reg_snumero_region = ? 
                                                                                            WHERE comuna.com_uid = ?;";

                            $sentencia->bind_param("sisi", $com_snombre, $ciu_snombre, $reg_snombre, $reg_snumero_region, $com_uid);

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