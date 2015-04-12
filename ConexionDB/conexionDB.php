<?php
/**
 * MiConexion es una extension local a la clase de servicio
 * mysqli.
 * Se encarga de configurar la conexion de acuerdo a nuestras
 * necesidades.
 * Si es necesario, podemos agregar metodos extra.
 *
 */
class conexionDB extends mysqli {

    // propiedades que representan parametros de conexion
    private $host_bd = 'localhost';
    private $user_bd = 'root';
    private $pass_bd = '';
    private $name_bd = 'compuOrder';
    /**
     * Contructor de esta clase...
     * fijense en el nombre : (guion bajo)(guion bajo)construct
     * En php, cada clase puede tener 1 solo constructor.
     */
    public function  __construct() {
        // lo primero, llamar al constructor de la clase padre...
        // observen que no se usa super, sino parent, y que la llamada
        // al constructor debe ser explicita.
        parent::__construct($this->host_bd, $this->user_bd,
                $this->pass_bd, $this->name_bd);
        if ($this->connect_error) {
            die('Connect Error (' . $this->connect_errno . ') '
                    . $this->connect_error);//el this es obligatorio usarlo
        }
        $this->set_charset("utf8");
    }
}
?>