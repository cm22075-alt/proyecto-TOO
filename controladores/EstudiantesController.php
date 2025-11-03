<?php
include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/Estudiante.php');

$estudianteModelo = new Estudiante($conexion);
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
      $titulo = 'Registrar Estudiante';
      $vista = dirname(__DIR__) . '/vistas/estudiantes/crearEstudiantes.php';
      include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
      header("Location: " . BASE_URL . "/index.php?modulo=estudiantes&accion=listar");
      exit;
    } else {
      include_once(dirname(__DIR__) . '/vistas/estudiantes/crearEstudiantes.php');
    }
    break;

  case 'editar':
    $id = $_GET['id'] ?? null;
    if (!$id) {
      echo "ID no proporcionado.";
      exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $estudianteModelo->actualizar($id, $_POST);
      header("Location: " . BASE_URL . "/index.php?modulo=estudiantes&accion=listar");
      exit;
    } else {
      $estudiante = $estudianteModelo->obtener($id);
      include_once(dirname(__DIR__) . '/vistas/estudiantes/editarEstudiantes.php');
      $titulo = 'Registrar Estudiante';
      $vista = dirname(__DIR__) . '/vistas/estudiantes/editarEstudiantes.php';
      include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    }
    break;

  case 'eliminar':
    $id = $_GET['id'] ?? null;
    if ($id) {
      $estudianteModelo->eliminar($id);
    }
    header("Location: " . BASE_URL . "/index.php?modulo=estudiantes&accion=listar");
    exit;

  default:
    echo "Acción no reconocida.";
}
