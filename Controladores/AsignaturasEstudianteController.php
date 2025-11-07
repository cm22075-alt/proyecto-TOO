<?php
require_once __DIR__ . '/../modelos/AsignaturaEstudiante.php';

class AsignaturasEstudianteController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new AsignaturaEstudiante();
    }

    public function listar()
    {
        
        $asignaturas = $this->modelo->listar();

        
        $titulo = 'Asignaturas del Estudiante';

        
        $vista = 'asignaturas/asignaturaEstudiantes.php';

        
        require __DIR__ . '/../vistas/plantillas/layoutEstudiante.php';
    }
}
