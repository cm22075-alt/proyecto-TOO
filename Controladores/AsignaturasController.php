<?php
// Controladores/AsignaturasController.php

// Incluir el Modelo (NO la configuración de DB, el Modelo ya lo hace)
require_once __DIR__ . '/../Modelos/Asignatura.php';

class AsignaturasController // Nombre de clase correcto para el Router
{
    private $modelo;

    public function __construct()
    {
        // Instanciar el modelo para poder usar sus métodos
        $this->modelo = new Asignatura();
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
