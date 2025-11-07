<?php
include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/Asignatura.php');


$asignaturaModelo = new Asignatura($conexion);
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
  case 'listar':
    $asignaturas = $asignaturaModelo->listar();
    $titulo = 'Asignaturas';
    $vista = dirname(__DIR__) . '/vistas/asignaturas/listarAsignaturas.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    break;

  case 'crear':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $resultado = $asignaturaModelo->crear($_POST);
      if ($resultado === true) {
        header("Location: " . BASE_URL . "/index.php?modulo=asignaturas&accion=listar");
        exit;
      } else {
        $error = $resultado;
      }
    }
    $titulo = 'Nueva Asignatura';
    $vista = dirname(__DIR__) . '/vistas/asignaturas/crearAsignaturas.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    include_once(dirname(__DIR__) . '/modelos/Auditoria.php');
    $auditoria = new Auditoria($conexion);

    break;

  case 'editar':
    $id = $_GET['id'] ?? null;
    if (!$id) { echo "ID no proporcionado."; exit; }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $resultado = $asignaturaModelo->actualizar($id, $_POST);
      if ($resultado === true) {
        header("Location: " . BASE_URL . "/index.php?modulo=asignaturas&accion=listar");
        exit;
      } else {
        $error = $resultado;
      }
    }

    $asignatura = $asignaturaModelo->obtener($id);
    $titulo = 'Editar Asignatura';
    $vista = dirname(__DIR__) . '/vistas/asignaturas/editarAsignaturas.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    break;

  case 'eliminar':
    $id = $_GET['id'] ?? null;
    if ($id) $asignaturaModelo->eliminar($id);
    header("Location: " . BASE_URL . "/index.php?modulo=asignaturas&accion=listar");
    exit;

  case 'cambiarEstado':
    $id = $_GET['id'] ?? null;
    if ($id) $asignaturaModelo->cambiarEstado($id);
    header("Location: " . BASE_URL . "/index.php?modulo=asignaturas&accion=listar");
    exit;

  default:
    echo "Acción no reconocida.";
}
?>
