<?php
// Controladores/TutoresController.php

// Incluir el Modelo (Tutor.php)
require_once __DIR__ . '/../Modelos/Tutor.php'; 


class TutoresController // ¡Nombre de clase correcto para el Router!
{
    private $modelo;

    public function __construct()
    {
        // Instanciar el Modelo, donde reside la lógica de DB.
        $this->modelo = new Tutor();
    }

    // =======================================================
    // MÉTODO LISTAR (Ruta: GET /tutores)
    // =======================================================
    public function listar()
    {
        // 1. Obtener datos del Modelo
        $tutores = $this->modelo->listar(); 
        
        // 2. Cargar vista
        $titulo = 'Listado de Tutores';
        
        // La vista a inyectar en el layout
        // NOTA: Debes crear este archivo si no existe.
        $vista = 'tutores/listarTutores.php'; 
        
        require __DIR__ . '/../vistas/plantillas/layout.php'; 
    }

    // =======================================================
    // MÉTODO CREAR (Ruta: GET/POST /tutores/crear)
    // =======================================================
    public function crear()
    {
        $titulo = 'Nuevo Tutor';
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = $this->modelo->crear($_POST);
            
            if ($resultado === true) {
                header("Location: " . BASE_URL . "/tutores"); 
                exit;
            } else {
                $error = $resultado;
            }
        }
        
        $vista = 'tutores/crearTutores.php';
        require __DIR__ . '/../vistas/plantillas/layout.php';
    }

    // =======================================================
    // MÉTODO EDITAR (Ruta: GET/POST /tutores/editar)
    // =======================================================
    public function editar()
    {
        // Usamos $_GET para obtener el ID, ya que el Router debe pasarlo como parámetro (ej: /tutores/editar?id=X)
        $id = $_GET['id'] ?? null; 
        if (!$id) {
            header("Location: " . BASE_URL . "/tutores"); 
            exit;
        }
        
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = $this->modelo->actualizar($id, $_POST);
            
            if ($resultado === true) {
                header("Location: " . BASE_URL . "/tutores");
                exit;
            } else {
                $error = $resultado;
            }
        }

        $tutor = $this->modelo->obtener($id); // Obtiene el dato a editar
        $titulo = 'Editar Tutor';
        $vista = 'tutores/editarTutores.php';
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
        header("Location: " . BASE_URL . "/tutores");
        exit;
    }
    
    public function cambiarEstado()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->cambiarEstado($id);
        }
        header("Location: " . BASE_URL . "/tutores");
        exit;
    }
}
