<?php

include_once(dirname(__DIR__) . '/modelos/ReporteSesion.php');
$reporteModelo = new Reporte($conexion);

switch ($accion) {
  case 'sesionesEstudiante':
    $titulo = 'Reporte de Sesiones por Estudiante';
    $vista = dirname(__DIR__) . '/vistas/reportes/sesionesEstudiante.php';

    $resultados = [];
    $fechaInicio = '';
    $fechaFin = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $fechaInicio = $_POST['fecha_inicio'];
      $fechaFin = $_POST['fecha_fin'];
      $resultados = $reporteModelo->sesionesPorEstudiante($fechaInicio, $fechaFin);
    }

    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    break;
}
