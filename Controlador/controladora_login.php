<?php
require_once 'comun/conexionBD.php';
require_once '../phpass-0.3/PasswordHash.php'

class ControladoraLogin
{
	private $SqlQuery;
	private $datos;

	public function validarUsuario($usuario, $pass)
	{
		$respuesta = array();
		$conexion = new MySqlCon();
		$this->datos = '';
		try
		{
			$this->SqlQuery = '';
			$this->SqlQuery = "SELECT per.uid, per.per_sermail, con.conusu_scontrasena FROM Personal per, Contrasena con WHERE per.per_uid = con.comusu_uid AND per.per_sermail = ?";

		   	$sentencia=$conexion->prepare($this->SqlQuery);
		   	$sentencia->bind_param("s",$usuario);
		   	if($sentencia->execute())
        	{
        		$sentencia->bind_result($uid,$mail, $pass);
        		
    			$hasher = new PasswordHash(8, false);	
	        	if($sentencia->fetch())
	        	{
	        		
	        		if($habilitado==1)
    				{	
		        		if($hasher->CheckPassword($pass, $passBD))
				        {
				        	$respuesta["uid"] = $uid;
				        	$respuesta["motivo"] = $mail;
				        	$respuesta["motivo"] = "Login Ok";
				        }			
				        else
				        {
				        	$respuesta["motivo"] = "Usuario o Contrasena no correcta";
				        }
		      		}
			      	else
	        		{
	        			$respuesta["motivo"] = "Usuario Desabilitado";
	        		}	        		
	        	}
	        	
      		}
       		$conexion->close();
		}
		catch(Exception $e)
		{
			throw new $e("Error al listar ordenes");
		}
		return $respuesta;
	}

}
