<?php
include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/Asignatura.php');

$asignaturaModelo = new Asignatura($conexion);
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'listar':
        $asignaturas = $asignaturaModelo->obtenerTodos();
        $titulo = 'Asignaturas';
        $vista = dirname(__DIR__) . '/vistas/asignaturas/listarAsignaturas.php';
        include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
        include_once(dirname(__DIR__) . '/vistas/asignaturas/listarAsignaturas.php');
        break;

    case 'crear':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $asignaturaModelo->crear($_POST['codigo'], $_POST['nombre']);
            header("Location: " . BASE_URL . "/index.php?modulo=asignaturas&accion=listar");
            exit;
        } else {
            $titulo = 'Crear Asignatura';
            $vista = dirname(__DIR__) . '/vistas/asignaturas/crearAsignaturas.php';
            include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
            include_once(dirname(__DIR__) . '/vistas/asignaturas/crearAsignaturas.php');
        }
        break;

    case 'editar':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no proporcionado.";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $asignaturaModelo->actualizar($id, $_POST['codigo'], $_POST['nombre'], $_POST['estado']);
            header("Location: " . BASE_URL . "/index.php?modulo=asignaturas&accion=listar");
            exit;
        } else {
            $data = $asignaturaModelo->obtenerPorId($id);
            $titulo = 'Editar Asignatura';
            $vista = dirname(__DIR__) . '/vistas/asignaturas/editarAsignaturas.php';
            include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
            include_once(dirname(__DIR__) . '/vistas/asignaturas/editarAsignaturas.php');
        }
        break;

    case 'cambiarEstado':
        $id = $_POST['id'] ?? null;
        $estado = $_POST['estado'] ?? null;
        if ($id !== null && $estado !== null) {
            $asignaturaModelo->cambiarEstado($id, $estado);
        }
        header("Location: " . BASE_URL . "/index.php?modulo=asignaturas&accion=listar");
        exit;
        break;

    case 'eliminar':
        $id = $_POST['id'] ?? null;
        if ($id !== null) {
            $asignaturaModelo->eliminar($id);
        }
        header("Location: " . BASE_URL . "/index.php?modulo=asignaturas&accion=listar");
        exit;
        break;

    default:
        echo "Acción no reconocida.";
        break;
}
