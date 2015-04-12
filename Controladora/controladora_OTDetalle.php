<?php
require_once '../ConexionDB/conexionDB.php';;

class ControladoraOTDetalle
{
	function insertarOTDetalle(OTDetalle $OTDetalle)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$det_dfechaComienzo = $OTDetalle->$det_dfechaComienzo;
		$det_dfechaTermino = $OTDetalle->$det_dfechaTermino;
		$det_ncoordenadaX = $OTDetalle->$det_ncoordenadaX;
		$det_ncoordenadaY = $OTDetalle->$det_ncoordenadaY;
		$det_sdescripcion = $OTDetalle->$det_sdescripcion;
		$fk_res_uid = $OTDetalle->$fk_res_uid;
		$fk_pln_uid = $OTDetalle->$fk_pln_uid;
		$fk_fal_uid = $OTDetalle->$fk_fal_uid;
		$fk_ser_uid = $OTDetalle->$fk_ser_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO OTDetalle VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("ssiisiiii", $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
											$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, $fk_fal_uid
											$fk_ser_uid);

			if($sentencia_insertar->execute() )
			{
				$conexion->close();
				return $sentencia_insertar->insert_id;
			}
			else
			{
				$conexion->close();
				return false;
			}
		}
		catch(Exception $e)
		{
			return false;
			throw new $e("Error al ingresar el detalle de la OT.");
		}
	}
	
	function listarOTDetalle()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM OTDetalle";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
									$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
									$fk_fal_uid, $fk_ser_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$OTDetalle = new OTDetalle();
					$OTDetalle ->initClass($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
									$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
									$fk_fal_uid, $fk_ser_uid);
					$this->datos[$indice] = $OTDetalle;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar el detalle de la OT.");
		}
		
		return $this->datos;
	}
	
	function listarOTDetallePorResponsable($fk_res_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM OTDetalle WHERE fk_res_uid LIKE ?";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			$nombreParam = "%".$fk_res_uid."%";
			$sentencia_listar->bind_param('s', $nombreParam);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
									$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
									$fk_fal_uid, $fk_ser_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$OTDetalle = new OTDetalle();
					$OTDetalle ->initClass($det_uid, $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
									$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
									$fk_fal_uid, $fk_ser_uid);
					$this->datos[$indice] = $OTDetalle;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar detalle de la OT.");
		}
		
		return $this->datos;
	}
	
	public function modificarOTDetalle(OTDetalle $OTDetalle)
	{
		$det_uid = $OTDetalle->det_uid$;
		$det_dfechaComienzo = $OTDetalle->$det_dfechaComienzo;
		$det_dfechaTermino = $OTDetalle->$det_dfechaTermino;
		$det_ncoordenadaX = $OTDetalle->$det_ncoordenadaX;
		$det_ncoordenadaY = $OTDetalle->$det_ncoordenadaY;
		$det_sdescripcion = $OTDetalle->$det_sdescripcion;
		$fk_res_uid = $OTDetalle->$fk_res_uid;
		$fk_pln_uid = $OTDetalle->$fk_pln_uid;
		$fk_fal_uid = $OTDetalle->$fk_fal_uid;
		$fk_ser_uid = $OTDetalle->$fk_ser_uid;
		
		$conexion = new conexionDB();
		$this->datos = '';

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE OTDetalle SET det_dfechaComienzo = ?, det_dfechaTermino = ?, 
											det_ncoordenadaX = ?, det_sdescripcion = ?, fk_res_uid = ?, 
											fk_pln_uid = ?, fk_fal_uid = ?, fk_ser_uid = ?
											WHERE det_uid = ?;";

			$sentencia_modificar = $conexion->prepare($this->SqlQuery);
			$sentencia_modificar->bind_param("ssiisiiiii", $det_dfechaComienzo, $det_dfechaTermino, $det_ncoordenadaX, 
									$det_ncoordenadaY, $det_sdescripcion, $fk_res_uid, $fk_pln_uid, 
									$fk_fal_uid, $fk_ser_uid, $det_uid);

			if($sentencia_modificar->execute() )
			{
				if($sentencia_modificar->affected_rows)
				{
	      			$conexion->close();
					return "Modificado";
				}
				else
				{
					$conexion->close();
					return "Error";
				}
			}
			else
			{
				$conexion->close();
	        	return "Error";
	        }
		}
		catch(Exception $e)
		{
			return false;
			throw new  $e("Error al modificar el detalle de la OT.");
		}
	}
	
	function eliminarOTDetalle($det_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM OTDetalle
											WHERE det_uid = ?;";
								
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);								
			$sentencia_eliminar->bind_param("i", $det_uid);
			
			if($sentencia_eliminar->execute() )
			{
				if($sentencia_eliminar->affected_rows)
	      		{
		      		$conexion->close();
					return "Eliminado";
				}
				else
				{
					$conexion->close();
					return "Error Eliminando";
				}
			}
			else
			{
				$conexion->close();
	        	return "Error";
	        }
		}
		catch(Exception $e)
		{
			return "Error Exception";
			throw new $e("Error al eliminar el detalle de la OT.");
		}
	}
}
?>