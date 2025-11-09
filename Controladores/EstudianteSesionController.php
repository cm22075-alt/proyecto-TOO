<?php
require_once __DIR__ . '/../modelos/Sesion.php';

class EstudianteSesionController {
    private $sesionModelo;

    public function __construct() {
        global $conexion;
        $this->sesionModelo = new Sesion($conexion);
    }

    public function listar() {
        
        $sesiones = $this->sesionModelo->listar();

       
        $titulo = 'Sesiones disponibles';

       
        $vista = 'sesiones/estudiantelistarSesiones.php';

        
        require __DIR__ . '/../vistas/plantillas/layoutEstudiante.php';
    }
}
