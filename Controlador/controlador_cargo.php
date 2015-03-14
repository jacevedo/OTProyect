<?php
    require_once '../Comun/conexionDB.php';

    class ControladoraCargo
    {
            private $sql;

            public function agregarCargo($car_snombre)
            {
                    $respuesta = array();
                    $conexion = new conexionDB();
                    $this->datos = '';

                    try
                    {
                            $this->SqlQuery = '';
                            $this->SqlQuery = $this->sql = "INSERT INTO cargo VALUES (null, ?);";

                            $sentencia = $conexion->prepare($this->SqlQuery);
                            $sentencia->bind_param("s", $car_snombre);

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

            public function modificarCargo($car_snombre, $car_uid)
            {
                    $respuesta = array();
                    $conexion = new conexionDB();
                    $this->datos = '';

                    try
                    {
                            $this->SqlQuery = '';
                            $this->SqlQuery = $this->sql = "UPDATE cargo set car_snombre = ?
                                                                                            WHERE car_uid = ?;";

                            $sentencia->bind_param("si", $car_snombre, $car_uid);

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

            function buscarCargoNombre($car_snombre)
            {
                    $conexion = new conexionDB();
                    // if($this->validarUsuario($idUsuario) )
                    // {
                            $sql_buscar = "select * from cargo where car_snombre = ?";
                            $sentencia_buscar = $conexion->prepare($sql_buscar);
                            $sentencia_buscar->bind_param('s', $car_snombre);
                            $sentencia_buscar->execute();
                            $sentencia_buscar->bind_result($car_snombre);

                            if($sentencia_buscar->fetch() )
                            {
                                    $response["regNombre"] = $reg_snombre;
                                    return $response;
                            }
                            else
                            {
                                    $response["regNombre"] = "None";
                                    //$response["state"] = "Error";
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