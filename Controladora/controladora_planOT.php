<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraPlanOT
{
	function insertarPlanOT(PlanOT $planOT)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$pln_dfechaHoraPlan = $planOT->$pln_dfechaHoraPlan;
		$pln_sdescripcion = $planOT->$pln_sdescripcion;
		$pln_dfechaHoraEmisionIdeal = $planOT->$pln_dfechaHoraEmisionIdeal;
		$fk_per_uid = $planOT->$fk_per_uid;
		$fk_tipest_uid = $planOT->$fk_tipest_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO planOT VALUES (null, ?, ?, ?, ?, ?);";

			$sentencia_agregar = $conexion->prepare($this->SqlQuery);
			$sentencia_agregar->bind_param("sssii", $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid);

			if($sentencia_agregar->execute() )
			{
				$conexion->close();
				return $sentencia_agregar->insert_id;
			}
			else
			{
				$conexion->close();
	        	return -1;
	        }
		}
		catch(Exception $e)
		{
			return false;
			throw new $e("Error al insertar plan de la OT.");
		}
	}
	
	function listarPlanOT()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM planOT";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($pln_uid, $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$planOT = new PlanOT();
					$planOT ->initClass($pln_uid, $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, $fk_per_uid, $fk_tipest_uid);
					$this->datos[$indice] = $planOT;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar plan de la OT.");
		}
		
		return $this->datos;
	}
	
	function modificarPlanOT(PlanOT $planOT)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$pln_dfechaHoraPlan = $PlanOT->$pln_dfechaHoraPlan;
		$pln_sdescripcion = $PlanOT->$pln_sdescripcion;
		$pln_dfechaHoraEmisionIdeal = $PlanOT->$pln_dfechaHoraEmisionIdeal;
		$fk_per_uid = $PlanOT->$fk_per_uid;
		$fk_tipest_uid = $PlanOT->$fk_tipest_uid;
		$pln_uid = $PlanOT->$pln_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "UPDATE PlanOT SET pln_dfechaHoraPlan = ?, 
												 pln_sdescripcion = ?, 
												 pln_dfechaHoraEmisionIdeal = ?, 
												 fk_per_uid = ?, 
												 fk_tipest_uid = ?	
							   WHERE pln_uid = ?;";

			$sentencia_modificar->bind_param("sssiii", $pln_dfechaHoraPlan, $pln_sdescripcion, $pln_dfechaHoraEmisionIdeal, 
												$fk_per_uid, $fk_tipest_uid, $pln_uid);
			$sentencia_modificar = $conexion->prepare($this->SqlQuery);
												
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
						return "error";
				}
			}
			else
			{
				$conexion->close();
				return "error";
			}
		}
		catch(Exception $e)
		{
			return false;
			throw new $e("Error al modificar el plan de la OT.");
		}
	}
	
	function eliminarPlanOT($pln_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM planOT
											WHERE pln_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $pln_uid);
			
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
			throw new  $e("Error al eliminar el plan de la OT.");
		}
	}
}
?>