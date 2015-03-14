<?php
	require_once '../Comun/conexionDB.php';
	
	class ControladoraInsumoOT
	{
		private $sql;

		public function agregarInsumoOT($insot_ncantidad, $fk_ins_uid, $fk_det_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "INSERT INTO insumoOT VALUES (null, ?, ?, ?);";
				
				$sentencia = $conexion->prepare($this->SqlQuery);
				$sentencia->bind_param("iii", $insot_ncantidad, $fk_ins_uid, $fk_det_uid);
				
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
		
		public function modificarInsumoOT($insot_ncantidad, $fk_ins_uid, $fk_det_uid, $insot_uid)
		{
			$respuesta = array();
			$conexion = new conexionDB();
			$this->datos = '';
			
			try
			{
				$this->SqlQuery = '';
				$this->SqlQuery = $this->sql = "UPDATE insumoot set insot_ncantidad = ?, ins_sprecio = ?, ins_ncantidadDisponible = ?, fk_fam_uid = ?
												WHERE ins_uid = ?;";
				
				$sentencia->bind_param("ssiii", $insot_ncantidad, $ins_snombre, $ins_sprecio, $ins_ncantidadDisponible, $fk_fam_uid, $ins_uid);
				
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