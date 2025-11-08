<?php
include_once dirname(__DIR__) . '/config/db.php';

class ReporteSesion {
  private $db;

  public function __construct($conexion) {
    $this->db = $conexion;
  }

  public function sesionesPorEstudiante($fechaInicio, $fechaFin) {
    $sql = "
      SELECT 
        username AS estudiante,
        COUNT(s.id_sesion) AS total_sesiones,
        ROUND(COUNT(s.id_sesion) / COUNT(DISTINCT s.fecha), 1) AS promedio_sesiones
      FROM sesiones s
      JOIN estudiantes e ON s.id_estudiante = e.id_estudiante
      WHERE s.fecha BETWEEN ? AND ?
      GROUP BY e.id_estudiante
      ORDER BY total_sesiones DESC
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ss", $fechaInicio, $fechaFin);
    $stmt->execute();
    return $stmt->get_result();
  }
}
