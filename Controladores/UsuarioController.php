<?php
require_once dirname(__DIR__) . '/config/db.php'; // Asegura que $conexion esté disponible
require_once dirname(__DIR__) . '/modelos/Usuario.php';
require_once dirname(__DIR__) . '/modelos/Auditoria.php';

class UsuarioController {
    private $usuarioModelo;
    private $auditoriaModelo;

    public function __construct() {
        global $conexion;
        $this->usuarioModelo = new Usuario($conexion);
        $this->auditoriaModelo = new Auditoria($conexion);
    }

    public function listar() {
        $registros = $this->usuarioModelo->listar();
        $titulo = 'Listado de Usuarios';
        $vista = dirname(__DIR__) . '/vistas/usuarios/listarUsuarios.php';
        include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
        include_once($vista);
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rol = $_POST['rol'];
            $estado = $_POST['estado'];

            $this->usuarioModelo->crear($username, $password, $rol, $estado);

            // Registro en auditoría
            $this->auditoriaModelo->registrar(
                'usuario',
                'crear',
                'Se creó el usuario ' . $username,
                $_SESSION['usuario_id'] ?? 0
            );            

            header('Location: ' . BASE_URL . '/usuario');
            exit;
        }

        $titulo = 'Crear Usuario';
        $vista = dirname(__DIR__) . '/vistas/usuarios/crearUsuarios.php';
        include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
        include_once($vista);     
    }

    public function actualizar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "<p>ID no proporcionado.</p>";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $rol = $_POST['rol'];
            $estado = $_POST['estado'];

            $this->usuarioModelo->actualizar($id, $username, $rol, $estado);

            // Registro en auditoría
            $this->auditoriaModelo->registrar(
                'usuario',
                'crear',
                'Se creó el usuario ' . $username,
                $_SESSION['usuario_id'] ?? 0
            );            

            header('Location: ' . BASE_URL . '/usuario');
            exit;
        }

        $usuario = $this->usuarioModelo->obtenerPorId($id);
        $titulo = 'Actualizar Usuario';
        $vista = dirname(__DIR__) . '/vistas/usuarios/editarUsuarios.php';
        include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
        include_once($vista);
    }
}
