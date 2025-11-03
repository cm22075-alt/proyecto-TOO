<?php
class ReporteTutor {
  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function generarReporte($id_tutor, $fecha_inicio = null, $fecha_fin = null, $id_asignatura = null) {
    $sql = "SELECT 
              s.id_sesion,
              s.fecha_hora,
              s.observaciones,
              e.carnet,
              e.nombre AS estudiante_nombre,
              e.apellido AS estudiante_apellido,
              a.codigo AS asignatura_codigo,
              a.nombre AS asignatura_nombre,
              t.codigo AS tutor_codigo,
              t.nombre AS tutor_nombre,
              t.apellido AS tutor_apellido
            FROM sesion s
            INNER JOIN estudiante e ON s.id_estudiante = e.id_estudiante
            INNER JOIN asignatura a ON s.id_asignatura = a.id_asignatura
            INNER JOIN tutor t ON s.id_tutor = t.id_tutor
            WHERE s.id_tutor = $id_tutor";

    if ($fecha_inicio && $fecha_fin) {
      $fecha_inicio = $this->conexion->real_escape_string($fecha_inicio);
      $fecha_fin = $this->conexion->real_escape_string($fecha_fin);
      $sql .= " AND DATE(s.fecha_hora) BETWEEN '$fecha_inicio' AND '$fecha_fin'";
    }
    
    if ($id_asignatura) {
      $sql .= " AND s.id_asignatura = $id_asignatura";
    }
    
    $sql .= " ORDER BY s.fecha_hora DESC";
    
    return $this->conexion->query($sql);
  }

  public function obtenerEstadisticas($id_tutor, $fecha_inicio = null, $fecha_fin = null, $id_asignatura = null) {
    $sql = "SELECT 
              COUNT(*) AS total_sesiones,
              COUNT(DISTINCT s.id_estudiante) AS total_estudiantes,
              COUNT(DISTINCT s.id_asignatura) AS total_asignaturas
            FROM sesion s
            WHERE s.id_tutor = $id_tutor";
    
    if ($fecha_inicio && $fecha_fin) {
      $fecha_inicio = $this->conexion->real_escape_string($fecha_inicio);
      $fecha_fin = $this->conexion->real_escape_string($fecha_fin);
      $sql .= " AND DATE(s.fecha_hora) BETWEEN '$fecha_inicio' AND '$fecha_fin'";
    }
    
    if ($id_asignatura) {
      $sql .= " AND s.id_asignatura = $id_asignatura";
    }
    
    $resultado = $this->conexion->query($sql);
    return $resultado->fetch_assoc();
  }

  public function exportarCSV($id_tutor, $fecha_inicio = null, $fecha_fin = null, $id_asignatura = null) {
    $sesiones = $this->generarReporte($id_tutor, $fecha_inicio, $fecha_fin, $id_asignatura);
    
    $tutorInfo = $this->conexion->query("SELECT nombre, apellido FROM tutor WHERE id_tutor = $id_tutor")->fetch_assoc();
    $nombreTutor = $tutorInfo['nombre'] . ' ' . $tutorInfo['apellido'];
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="reporte_tutor_' . $id_tutor . '_' . date('Y-m-d') . '.csv"');

    $output = fopen('php://output', 'w');

    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

    fputcsv($output, ['REPORTE DE SESIONES POR TUTOR']);
    fputcsv($output, ['Tutor:', $nombreTutor]);
    fputcsv($output, ['Fecha de generación:', date('Y-m-d H:i:s')]);
    fputcsv($output, []); 

    fputcsv($output, [
      'ID Sesión',
      'Fecha y Hora',
      'Carnet Estudiante',
      'Estudiante',
      'Código Asignatura',
      'Asignatura',
      'Observaciones'
    ]);

    while ($row = $sesiones->fetch_assoc()) {
      fputcsv($output, [
        $row['id_sesion'],
        $row['fecha_hora'],
        $row['carnet'],
        $row['estudiante_nombre'] . ' ' . $row['estudiante_apellido'],
        $row['asignatura_codigo'],
        $row['asignatura_nombre'],
        $row['observaciones']
      ]);
    }
    
    fclose($output);
    exit;
  }

  public function exportarPDF($id_tutor, $fecha_inicio = null, $fecha_fin = null, $id_asignatura = null) {
    $sesiones = $this->generarReporte($id_tutor, $fecha_inicio, $fecha_fin, $id_asignatura);
    $estadisticas = $this->obtenerEstadisticas($id_tutor, $fecha_inicio, $fecha_fin, $id_asignatura);

    $tutorInfo = $this->conexion->query("SELECT nombre, apellido, especialidad FROM tutor WHERE id_tutor = $id_tutor")->fetch_assoc();

    $html = '<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: Arial, sans-serif; font-size: 12px; }
    h1 { color: #2c3e50; text-align: center; }
    .header { background-color: #3498db; color: white; padding: 15px; margin-bottom: 20px; }
    .info { margin-bottom: 20px; }
    .info p { margin: 5px 0; }
    .estadisticas { background-color: #ecf0f1; padding: 10px; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th { background-color: #3498db; color: white; padding: 8px; text-align: left; }
    td { border: 1px solid #ddd; padding: 8px; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #7f8c8d; }
  </style>
</head>
<body>
  <div class="header">
    <h1> REPORTE DE SESIONES POR TUTOR</h1>
  </div>
  
  <div class="info">
    <p><strong>Tutor:</strong> ' . htmlspecialchars($tutorInfo['nombre'] . ' ' . $tutorInfo['apellido']) . '</p>
    <p><strong>Especialidad:</strong> ' . htmlspecialchars($tutorInfo['especialidad'] ?? 'N/A') . '</p>
    <p><strong>Fecha de generación:</strong> ' . date('d/m/Y H:i:s') . '</p>';
    
    if ($fecha_inicio && $fecha_fin) {
      $html .= '<p><strong>Periodo:</strong> ' . date('d/m/Y', strtotime($fecha_inicio)) . ' - ' . date('d/m/Y', strtotime($fecha_fin)) . '</p>';
    }
    
    $html .= '</div>
    <div class="estadisticas">
    <h3> Estadísticas del Periodo</h3>
    <p><strong>Total de sesiones:</strong> ' . $estadisticas['total_sesiones'] . '</p>
    <p><strong>Estudiantes atendidos:</strong> ' . $estadisticas['total_estudiantes'] . '</p>
    <p><strong>Asignaturas impartidas:</strong> ' . $estadisticas['total_asignaturas'] . '</p>
    </div>
    <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Fecha y Hora</th>
        <th>Estudiante</th>
        <th>Asignatura</th>
        <th>Observaciones</th>
      </tr>
    </thead>
    <tbody>';
    
    while ($row = $sesiones->fetch_assoc()) {
      $html .= '<tr>
        <td>' . $row['id_sesion'] . '</td>
        <td>' . date('d/m/Y H:i', strtotime($row['fecha_hora'])) . '</td>
        <td>' . htmlspecialchars($row['estudiante_nombre'] . ' ' . $row['estudiante_apellido']) . '<br>
            <small>' . $row['carnet'] . '</small></td>
        <td>' . htmlspecialchars($row['asignatura_nombre']) . '<br>
            <small>' . $row['asignatura_codigo'] . '</small></td>
        <td>' . htmlspecialchars($row['observaciones'] ?? '-') . '</td>
      </tr>';
    }
    $html .= '</tbody>
    </table>
    <div class="footer">
    <p>Sistema de Gestión de Tutorías Académicas</p>
    </div>
    </body>
    </html>';

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="reporte_tutor_' . $id_tutor . '_' . date('Y-m-d') . '.pdf"');

    $tempHtml = tempnam(sys_get_temp_dir(), 'pdf') . '.html';
    file_put_contents($tempHtml, $html);
    passthru("wkhtmltopdf $tempHtml -");
    unlink($tempHtml);
    
    
    exit;
  }
}
?>
