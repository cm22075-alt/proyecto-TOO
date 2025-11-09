<?php
require_once __DIR__ . '/../modelos/Sesion.php';
require_once __DIR__ . '/../modelos/Auditoria.php';

class SesionController {
    private $sesionModelo;
    private $auditoria;

    public function __construct() {
        global $conexion;
        $this->sesionModelo = new Sesion($conexion);
        $this->auditoria = new Auditoria($conexion);
    }

  
    public function listar() {
        $sesiones = $this->sesionModelo->listar();
        $titulo = 'Sesiones registradas';

        require __DIR__ . '/../vistas/plantillas/layout.php';
        require __DIR__ . '/../vistas/sesiones/listarSesiones.php';
    }

   
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $datos = $_POST;
            if (!isset($datos['estudiantes']) || !is_array($datos['estudiantes'])) {
                die("❌ No se seleccionaron estudiantes.");
            }

            
            foreach ($datos['estudiantes'] as $id_estudiante) {
                $this->sesionModelo->crear([
                    'id_estudiante' => $id_estudiante,
                    'id_tutor' => $datos['id_tutor'],
                    'id_asignatura' => $datos['id_asignatura'],
                    'fecha_hora' => $datos['fecha_hora'],
                    'observaciones' => $datos['observaciones'],
                    'creado_por' => $_SESSION['usuario_id']
                ]);

                $descripcion = "Se registró sesión para estudiante ID {$id_estudiante}";
                $this->auditoria->registrar('sesion', 'crear', $descripcion, $_SESSION['usuario_id']);
            }

            
            header("Location: " . BASE_URL . "/sesiones");
            exit;
        }

        
        $titulo = 'Registrar sesión grupal';
        require __DIR__ . '/../vistas/plantillas/layout.php';
        require __DIR__ . '/../vistas/sesiones/crearSesiones.php';
    }

  
    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            header("Location: " . BASE_URL . "/sesiones");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $this->sesionModelo->actualizar($id, $_POST);

            $descripcion = "Se modificó la sesión ID {$id}";
            $this->auditoria->registrar('sesion', 'editar', $descripcion, $_SESSION['usuario_id']);

          
            header("Location: " . BASE_URL . "/sesiones");
            exit;
        }

        
        $sesion = $this->sesionModelo->obtener($id);
        if (!$sesion) {
            header("Location: " . BASE_URL . "/sesiones");
            exit;
        }

        $titulo = 'Editar sesión';
        require __DIR__ . '/../vistas/plantillas/layout.php';
        require __DIR__ . '/../vistas/sesiones/editarSesiones.php';
    }


    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id && is_numeric($id)) {
            session_start();
            $this->sesionModelo->eliminar($id);

            $descripcion = "Se eliminó la sesión ID {$id}";
            $this->auditoria->registrar('sesion', 'eliminar', $descripcion, $_SESSION['usuario_id']);
        }

      
        header("Location: " . BASE_URL . "/sesiones");
        exit;
    }
}
