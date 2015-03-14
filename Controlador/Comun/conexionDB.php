<?php
        /**
         * conexionDB.php
         * 
         * Provee una conexion con la base de datos
         * 
         * este archivo solo es para que sea mas ordenado el codigo de otras 
         * paginas que lo utilizan
         */


        $host_db = 'localhost';
        $name_db = 'compuOrder';
        $user_db = 'root';
        $pass_db = '';
        $conexion = new mysqli($host_db, $user_db, $pass_db, $name_db);
        //informe si hay error
        if($conexion->connect_error)
        {
            die("Se produjo un error de conexion: <br />".
            $conexion->connect_errno ." - ".
            $conexion->connect_errno);
        }
        $conexion->set_charset("utf8");
?>
