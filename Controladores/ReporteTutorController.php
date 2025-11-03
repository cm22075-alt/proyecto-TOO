<?php
include_once(dirname(__DIR__) . '/Config/db.php');
include_once(dirname(__DIR__) . '/Modelos/ReporteTutor.php');
include_once(dirname(__DIR__) . '/Modelos/Tutor.php');
include_once(dirname(__DIR__) . '/Modelos/Asignatura.php');

$reporteModelo = new ReporteTutor($conexion);
$tutorModelo = new Tutor($conexion);
$asignaturaModelo = new Asignatura($conexion);

$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
  case 'listar':
    $tutores = $tutorModelo->listar();
    $asignaturas = $asignaturaModelo->listar();
    
    $titulo = 'Reporte por Tutor';
    $vista = dirname(__DIR__) . '/vistas/reportes/filtroReporteTutor.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    break;

  case 'generar':
    $id_tutor = $_GET['id_tutor'] ?? null;
    $fecha_inicio = $_GET['fecha_inicio'] ?? null;
    $fecha_fin = $_GET['fecha_fin'] ?? null;
    $id_asignatura = $_GET['id_asignatura'] ?? null;
    
    if (!$id_tutor) {
      $error = "Debe seleccionar un tutor";
      $tutores = $tutorModelo->listar();
      $asignaturas = $asignaturaModelo->listar();
      $titulo = 'Reporte por Tutor';
      $vista = dirname(__DIR__) . '/vistas/reportes/filtroReporteTutor.php';
      include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
      break;
    }
    
    $resultado = $reporteModelo->generarReporte($id_tutor, $fecha_inicio, $fecha_fin, $id_asignatura);
    $tutorInfo = $tutorModelo->obtener($id_tutor);
    
    $tutores = $tutorModelo->listar();
    $asignaturas = $asignaturaModelo->listar();
    
    $titulo = 'Resultado del Reporte';
    $vista = dirname(__DIR__) . '/vistas/reportes/resultadoReporteTutor.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    break;

  case 'exportar_csv':
    $id_tutor = $_GET['id_tutor'] ?? null;
    $fecha_inicio = $_GET['fecha_inicio'] ?? null;
    $fecha_fin = $_GET['fecha_fin'] ?? null;
    $id_asignatura = $_GET['id_asignatura'] ?? null;
    
    if (!$id_tutor) {
      echo "Error: Debe seleccionar un tutor";
      exit;
    }
    
    $reporteModelo->exportarCSV($id_tutor, $fecha_inicio, $fecha_fin, $id_asignatura);
    break;

  case 'exportar_pdf':
    $id_tutor = $_GET['id_tutor'] ?? null;
    $fecha_inicio = $_GET['fecha_inicio'] ?? null;
    $fecha_fin = $_GET['fecha_fin'] ?? null;
    $id_asignatura = $_GET['id_asignatura'] ?? null;
    
    if (!$id_tutor) {
      echo "Error: Debe seleccionar un tutor";
      exit;
    }
    
    $reporteModelo->exportarPDF($id_tutor, $fecha_inicio, $fecha_fin, $id_asignatura);
    break;

  default:
    echo "Acción no reconocida.";
}
?>