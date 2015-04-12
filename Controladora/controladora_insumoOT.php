<?php
require_once '../ConexionDB/conexionDB.php';

class ControladoraInsumoOT
{
	function insertarInsumoOT(InsumoOT $insumoOT)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$insot_ncantidad = $insumoOT->$insot_ncantidad;
		$fk_ins_uid = $insumoOT->$fk_ins_uid;
		$fk_det_uid = $insumoOT->$fk_det_uid;
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "INSERT INTO insumoOT VALUES (null, ?, ?, ?);";
			
			$sentencia_insertar = $conexion->prepare($this->SqlQuery);
			$sentencia_insertar->bind_param("iii", $insot_ncantidad, $fk_ins_uid, $fk_det_uid);
			
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
			throw new $e("Error al ingresar el insumo de la OT.");
		}
		
		return $respuesta;
	}

	function listarInsumoOT()
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT * FROM insumoOT";
			
			$sentencia_listar = $conexion->prepare($this->SqlQuery);
			
			if($sentencia_listar->execute() )
			{
				$sentencia_listar->bind_result($insot_uid, $insot_ncantidad, $fk_ins_uid, $fk_det_uid);
				$indice = 0;
				
				while($sentencia->fetch() )
				{
					$insumoOT = new InsumoOT();
					$insumoOT ->initClass($insot_uid, $insot_ncantidad, $fk_ins_uid, $fk_det_uid);
					$this->datos[$indice] = $insumoOT;
        			$indice++;
				}
			}
			
			$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar el insumo de la OT.");
		}
		
		return $this->datos;
	}
	
	function modificarInsumoOT(InsumoOT $insumoOT)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		$insot_uid = $insumoOT->$insot_uid;
		$insot_ncantidad = $insumoOT->$insot_ncantidad;
		$fk_ins_uid = $insumoOT->$fk_ins_uid;
		$fk_det_uid = $insumoOT->$fk_det_uid;

		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "UPDATE insumoOT SET insot_ncantidad = ? fk_ins_uid = ?, 
											fk_det_uid = ?
											WHERE insot_uid = ?;";

			$sentencia_modificar->bind_param("iiii", $insot_ncantidad, $fk_ins_uid, $fk_det_uid, $insot_uid);

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
			throw new $e("Error al modificar el insumo de la OT.");
		}
	}
	
	function eliminarInsumoOT($insot_uid)
	{
		$conexion = new conexionDB();
		$this->datos = '';
		
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = $this->sql = "DELETE FROM insumoOT
											WHERE insot_uid = ?;";
											
			$sentencia_eliminar = $conexion->prepare($this->SqlQuery);
			$sentencia_eliminar->bind_param("i", $insot_uid);
			
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
			throw new  $e("Error al eliminar el insumo de la OT.");
		}
	}
	
}
?>