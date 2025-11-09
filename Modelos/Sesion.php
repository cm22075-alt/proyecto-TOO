<?php
include_once dirname(__DIR__) . '/config/db.php';

class Sesion {
  private $db;

  public function __construct($conexion) {
    $this->db = $conexion;
  }


  public function listar() {
    $sql = "
      SELECT 
        s.*, 
        CONCAT(e.nombre, ' ', e.apellido) AS estudiante, 
        a.nombre AS asignatura, 
        t.nombre AS tutor
      FROM sesion s
      JOIN estudiante e ON s.id_estudiante = e.id_estudiante
      JOIN asignatura a ON s.id_asignatura = a.id_asignatura
      JOIN tutor t ON s.id_tutor = t.id_tutor
      ORDER BY s.fecha_hora DESC
    ";
    return $this->db->query($sql);
  }


  public function obtener($id) {
    $stmt = $this->db->prepare("
      SELECT 
        s.*, 
        CONCAT(e.nombre, ' ', e.apellido) AS estudiante, 
        a.nombre AS asignatura, 
        t.nombre AS tutor
      FROM sesion s
      JOIN estudiante e ON s.id_estudiante = e.id_estudiante
      JOIN asignatura a ON s.id_asignatura = a.id_asignatura
      JOIN tutor t ON s.id_tutor = t.id_tutor
      WHERE s.id_sesion = ?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

 
  public function crear($datos) {
    $stmt = $this->db->prepare("
      INSERT INTO sesion 
        (id_estudiante, id_tutor, id_asignatura, fecha_hora, observaciones, creado_por, creado_en)
      VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param(
      "iiissi",
      $datos['id_estudiante'],
      $datos['id_tutor'],
      $datos['id_asignatura'],
      $datos['fecha_hora'],
      $datos['observaciones'],
      $datos['creado_por']
    );
    return $stmt->execute();
  }

 
  public function actualizar($id, $datos) {
    $stmt = $this->db->prepare("
      UPDATE sesion 
      SET 
        id_estudiante = ?, 
        id_tutor = ?, 
        id_asignatura = ?, 
        fecha_hora = ?, 
        observaciones = ?, 
        actualizado_en = NOW()
      WHERE id_sesion = ?
    ");
    $stmt->bind_param(
      "iiissi",
      $datos['id_estudiante'],
      $datos['id_tutor'],
      $datos['id_asignatura'],
      $datos['fecha_hora'],
      $datos['observaciones'],
      $id
    );
    return $stmt->execute();
  }


  public function eliminar($id) {
    $stmt = $this->db->prepare("DELETE FROM sesion WHERE id_sesion = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }
}
