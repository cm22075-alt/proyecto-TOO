<?php
include_once dirname(__DIR__) . '/config/db.php';

class Estudiante {
  private $db;

  public function __construct($conexion) {
    $this->db = $conexion;
  }

  public function listar() {
    $sql = "SELECT * FROM estudiante ORDER BY id_estudiante ASC";
    return $this->db->query($sql);
  }

  public function obtener($id) {
    $stmt = $this->db->prepare("SELECT * FROM estudiante WHERE id_estudiante = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  public function crear($datos) {
    $stmt = $this->db->prepare("INSERT INTO estudiante (carnet, nombre, apellido, email, estado, creado_en, actualizado_en) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("ssssi", $datos['carnet'], $datos['nombre'], $datos['apellido'], $datos['email'], $datos['estado']);
    $stmt->execute();
  }

  public function actualizar($id, $datos) {
    $stmt = $this->db->prepare("UPDATE estudiante SET carnet=?, nombre=?, apellido=?, email=?, estado=?, actualizado_en=NOW() WHERE id_estudiante=?");
    $stmt->bind_param("ssssii", $datos['carnet'], $datos['nombre'], $datos['apellido'], $datos['email'], $datos['estado'], $id);
    $stmt->execute();
  }

  public function eliminar($id) {
    $stmt = $this->db->prepare("DELETE FROM estudiante WHERE id_estudiante = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
  }

  public function carnetExiste($carnet) {
    $stmt = $this->conexion->prepare("SELECT id_estudiante FROM estudiante WHERE carnet = ?");
    $stmt->bind_param("s", $carnet);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->num_rows > 0;
  }
}
