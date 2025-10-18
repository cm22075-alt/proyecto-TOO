<?php
include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/Estudiante.php');

$estudianteModelo = new Estudiante($conexion);
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
  case 'listar':
    $estudiantes = $estudianteModelo->listar();
    include_once(dirname(__DIR__) . '/vistas/estudiantes/listar.php');
    break;

  case 'crear':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $estudianteModelo->crear($_POST);
      header("Location: /proyecto-TOO/index.php?modulo=estudiantes&accion=listar");
    } else {
      include_once(dirname(__DIR__) . '/vistas/estudiantes/crear.php');
    }
    break;

  case 'editar':
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $estudianteModelo->actualizar($id, $_POST);
      header("Location: /proyecto-TOO/index.php?modulo=estudiantes&accion=listar");
    } else {
      $estudiante = $estudianteModelo->obtener($id);
      include_once(dirname(__DIR__) . '/vistas/estudiantes/editar.php');
    }
    break;

  case 'eliminar':
    $id = $_GET['id'];
    $estudianteModelo->eliminar($id);
    header("Location: /proyecto-TOO/index.php?modulo=estudiantes&accion=listar");
    break;

  default:
    echo "Acción no reconocida.";
}
