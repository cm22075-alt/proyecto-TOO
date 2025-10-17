<?php
include_once __DIR__ . '/../configuracion/bd.php';
include_once __DIR__ . '/../modelos/Estudiante.php';

$estudianteModelo = new Estudiante($conexion);

// Ruta: crear estudiante
if (isset($_GET['accion']) && $_GET['accion'] === 'crear') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = $_POST;
    if (!$estudianteModelo->carnetExiste($datos['carnet'])) {
      $estudianteModelo->crear($datos);
      header("Location: ../vistas/estudiantes/listar.php");
    } else {
      echo "El carnet ya está registrado.";
    }
  } else {
    include '../vistas/estudiantes/crear.php';
  }
}

// Ruta: listar estudiantes
if (!isset($_GET['accion'])) {
  $estudiantes = $estudianteModelo->listar();
  include '../vistas/estudiantes/listar.php';
}
