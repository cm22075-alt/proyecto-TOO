<?php

include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/Estudiante.php');
include_once(dirname(__DIR__) . '/modelos/Auditoria.php');

$estudianteModelo = new Estudiante($conexion);
$auditoria = new Auditoria($conexion);
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
  case 'listar':
    $estudiantes = $estudianteModelo->listar();
    //Layout para el encabezado y pie de pagina
    $titulo = 'Estudiantes';
    $vista = dirname(__DIR__) . '/vistas/estudiantes/listarEstudiantes.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    include_once(dirname(__DIR__) . '/vistas/estudiantes/listarEstudiantes.php');
    break;

  case 'crear':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $estudianteModelo->crear($_POST);
      // Registrar auditoría
      $descripcion = "Se creó el estudiante con carnet {$datos['carnet']}";
      $auditoria->registrar('estudiantes', 'crear', $descripcion, $_SESSION['usuario_id']);
      $titulo = 'Registrar Estudiante';
      $vista = dirname(__DIR__) . '/vistas/estudiantes/crearEstudiantes.php';
      include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
      header("Location: " . BASE_URL . "/index.php?modulo=estudiantes&accion=listar");
      exit;
    } else {
      include_once(dirname(__DIR__) . '/vistas/estudiantes/crearEstudiantes.php');

// Incluir el Modelo Estudiante (el Modelo es responsable de la DB)
require_once __DIR__ . '/../Modelos/Estudiante.php';

class EstudiantesController
{
    private $modelo;

    public function __construct()
    {
        // 1. Instanciar el Modelo. 
        // El constructor de Estudiante se encarga de obtener la conexión global ($conexion).
        $this->modelo = new Estudiante();

    }

    // =======================================================
    // MÉTODO LISTAR (Ruta: GET /estudiantes)
    // =======================================================
    public function listar()
    {
        // 1. Obtener datos del Modelo
        $estudiantes = $this->modelo->listar();
        
        // 2. Definir variables para la vista
        $titulo = 'Listado de Estudiantes';
        $vista = 'estudiantes/listarEstudiantes.php'; 
        
        // 3. Cargar el layout para mostrar el listado
        require __DIR__ . '/../vistas/plantillas/layout.php'; 
    }

    // =======================================================
    // MÉTODO CREAR (Ruta: GET /estudiantes/crear, POST /estudiantes/crear)
    // =======================================================
    public function crear()
    {
        $titulo = 'Registrar Estudiante';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Procesar y delegar la lógica de guardado al Modelo
            // Aquí deberías validar los datos antes de llamar al modelo
            $this->modelo->crear($_POST); 

            // 2. Redirigir a la lista después de guardar (usando la ruta limpia)
            header("Location: " . BASE_URL . "/estudiantes"); 
            exit;
        } 
        
        // Cargar el formulario de creación (para petición GET)
        $vista = 'estudiantes/crearEstudiantes.php';
        require __DIR__ . '/../vistas/plantillas/layout.php';
    }

    // =======================================================
    // MÉTODO EDITAR (Ruta: GET /estudiantes/editar, POST /estudiantes/editar)
    // =======================================================
    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
             header("Location: " . BASE_URL . "/estudiantes");
             exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delegar la actualización al Modelo
            $this->modelo->actualizar($id, $_POST);
            header("Location: " . BASE_URL . "/estudiantes");
            exit;
        } 
        
        // Mostrar formulario de edición
        $estudiante = $this->modelo->obtener($id); // Obtiene el dato a editar
        $titulo = 'Editar Estudiante';
        $vista = 'estudiantes/editarEstudiantes.php';
        require __DIR__ . '/../vistas/plantillas/layout.php';
    }

    // =======================================================
    // MÉTODO ELIMINAR (Ruta: GET /estudiantes/eliminar?id=X)
    // =======================================================
    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        
        // Solo elimina si hay un ID
        if ($id) {
            $this->modelo->eliminar($id);
        }
        
        // Redirigir siempre a la lista
        header("Location: " . BASE_URL . "/estudiantes");
        exit;
    }
}
