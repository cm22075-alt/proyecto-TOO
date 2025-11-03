<?php
include_once(dirname(__DIR__) . '/Config/db.php');
include_once(dirname(__DIR__) . '/Modelos/Tutor.php');

$tutorModelo = new Tutor($conexion);
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
  case 'listar':
    $tutores = $tutorModelo->listar();
    $titulo = 'Tutores';
    $vista = dirname(__DIR__) . '/vistas/tutores/listarTutores.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    break;

  case 'crear':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $resultado = $tutorModelo->crear($_POST);
      if ($resultado === true) {
        header("Location: " . BASE_URL . "/index.php?modulo=tutores&accion=listar");
        exit;
      } else {
        $error = $resultado;
      }
    }
    $titulo = 'Nuevo Tutor';
    $vista = dirname(__DIR__) . '/vistas/tutores/crearTutores.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    break;

  case 'editar':
    $id = $_GET['id'] ?? null;
    if (!$id) { echo "ID no proporcionado."; exit; }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $resultado = $tutorModelo->actualizar($id, $_POST);
      if ($resultado === true) {
        header("Location: " . BASE_URL . "/index.php?modulo=tutores&accion=listar");
        exit;
      } else {
        $error = $resultado;
      }
    }

    $tutor = $tutorModelo->obtener($id);
    $titulo = 'Editar Tutor';
    $vista = dirname(__DIR__) . '/vistas/tutores/editarTutores.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    break;

  case 'eliminar':
    $id = $_GET['id'] ?? null;
    if ($id) $tutorModelo->eliminar($id);
    header("Location: " . BASE_URL . "/index.php?modulo=tutores&accion=listar");
    exit;

  case 'cambiarEstado':
    $id = $_GET['id'] ?? null;
    if ($id) $tutorModelo->cambiarEstado($id);
    header("Location: " . BASE_URL . "/index.php?modulo=tutores&accion=listar");
    exit;

  default:
    echo "Acción no reconocida.";
}
?>