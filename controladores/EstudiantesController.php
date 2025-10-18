<?php
include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/Estudiante.php');

$estudianteModelo = new Estudiante($conexion);
$accion = $_GET['accion'] ?? 'listar';

if ($accion === 'listar') {
  $estudiantes = $estudianteModelo->listar();
  include_once(dirname(__DIR__) . '/vistas/estudiantes/listar.php');
} elseif ($accion === 'crear') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = $_POST;
    $estudianteModelo->crear($datos);
    header("Location: ../index.php?modulo=estudiantes");
  } else {
    include_once(dirname(__DIR__) . '/vistas/estudiantes/crear.php');
  }
} else {
  echo "Acción no reconocida.";
}
