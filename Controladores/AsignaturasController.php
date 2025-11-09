<?php
// Controladores/AsignaturasController.php

// Incluir el Modelo (NO la configuración de DB, el Modelo ya lo hace)
require_once __DIR__ . '/../Modelos/Asignatura.php';
require_once dirname(__DIR__) . '/modelos/Auditoria.php';
require_once dirname(__DIR__) . '/config/db.php'; // Asegura que $conexion esté disponible

class AsignaturasController // Nombre de clase correcto para el Router
{
    private $modelo;
    private $auditoriaModelo;

    public function __construct()
    {
        global $conexion;
        // Instanciar el modelo para poder usar sus métodos
        $this->modelo = new Asignatura();
        $this->auditoriaModelo = new Auditoria($conexion);
    }

    // =======================================================
    // MÉTODO LISTAR (Ruta: GET /asignaturas)
    // =======================================================
    public function listar()
    {
        // 1. Obtener datos
        $asignaturas = $this->modelo->listar(); 
        
        // 2. Cargar vista
        $titulo = 'Listado de Asignaturas';
        $vista = 'asignaturas/listarAsignaturas.php'; 
        
        require __DIR__ . '/../vistas/plantillas/layout.php';
    }

    // =======================================================
    // MÉTODO CREAR (Ruta: GET/POST /asignaturas/crear)
    // =======================================================
    public function crear()
    {
        $titulo = 'Nueva Asignatura';
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = $this->modelo->crear($_POST);
            
            if ($resultado === true) {
                header("Location: " . BASE_URL . "/asignaturas"); 
                exit;
            } else {
                $error = $resultado;
            }
        }
        // Registro en auditoría
        $this->auditoriaModelo->registrar(
            'asignatura',
            'crear',
            'Se creó una asignatura ' . $username,
            $_SESSION['usuario_id'] ?? 0
        ); 
        $vista = 'asignaturas/crearAsignaturas.php';
        require __DIR__ . '/../vistas/plantillas/layout.php';
    }

    // =======================================================
    // MÉTODO EDITAR (Ruta: GET/POST /asignaturas/editar)
    // =======================================================
    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . BASE_URL . "/asignaturas"); 
            exit;
        }
        
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = $this->modelo->actualizar($id, $_POST);
            
            if ($resultado === true) {

           // Obtener nombre de la asignatura actualizada
        $asignatura = $this->modelo->obtener($id);
        $nombre = $asignatura['nombre'] ?? 'desconocida';

        // Registrar en auditoría
        $this->auditoriaModelo->registrar(
            'asignatura',
            'actualizar',
            'Se actualizó la asignatura "' . $nombre . '" con ID ' . $id,
            $_SESSION['usuario_id'] ?? 0
        ); 
                header("Location: " . BASE_URL . "/asignaturas");
                exit;
            } else {
                $error = $resultado;
            }
        }

        $asignatura = $this->modelo->obtener($id); // Obtiene el dato a editar
        $titulo = 'Editar Asignatura';
        $vista = 'asignaturas/editarAsignaturas.php';
        require __DIR__ . '/../vistas/plantillas/layout.php';
    }

    // =======================================================
    // MÉTODOS DE ACCIÓN RÁPIDA (Eliminar y Cambiar Estado)
    // =======================================================
    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->eliminar($id);
        }
        header("Location: " . BASE_URL . "/asignaturas");
        exit;
    }
    
    public function cambiarEstado()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->cambiarEstado($id);
        }
        header("Location: " . BASE_URL . "/asignaturas");
        exit;
    }
}
