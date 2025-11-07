<?php
include_once('config/db.php');
include_once('modelos/Sesion.php');

$sesion = new Sesion($conexion);

// Obtener filtros del formulario
$inicio = $_POST['fecha_inicio'] ?? '';
$fin = $_POST['fecha_fin'] ?? '';
$idTutor = $_POST['id_tutor'] ?? '';
$idAsignatura = $_POST['id_asignatura'] ?? '';

// Validar fechas
if (!$inicio || !$fin) {
  die("Fechas no válidas para exportar.");
}

// Obtener datos filtrados
$reporte = $sesion->reporteFiltrado($inicio, $fin, $idTutor, $idAsignatura);

// Configurar cabeceras para descarga CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="reporte_sesiones.csv"');

// Abrir salida
$output = fopen('php://output', 'w');

// Encabezados
fputcsv($output, ['#', 'Estudiante', 'Total sesiones', 'Promedio por día', 'Nivel de seguimiento']);

$i = 1;
while ($r = $reporte->fetch_assoc()) {
  $nivel = $r['total_sesiones'] >= 7 ? 'Alto' : ($r['total_sesiones'] >= 4 ? 'Medio' : 'Bajo');
  fputcsv($output, [
    $i++,
    $r['estudiante'],
    $r['total_sesiones'],
    $r['promedio'],
    $nivel
  ]);
}

fclose($output);
exit;
