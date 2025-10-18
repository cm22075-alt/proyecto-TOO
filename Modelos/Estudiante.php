<?php
include_once dirname(__DIR__) . '/config/db.php';

class Estudiante {
  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function listar() {
    return $this->conexion->query("SELECT * FROM estudiante");
  }

  public function crear($datos) {
    $stmt = $this->conexion->prepare("INSERT INTO estudiante (carnet, nombre, apellido, email, estado, creado_en, actualizado_en) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("sssss", $datos['carnet'], $datos['nombre'], $datos['apellido'], $datos['email'], $datos['estado']);
    return $stmt->execute();
  }

  public function obtener($id) {
    $stmt = $this->conexion->prepare("SELECT * FROM estudiante WHERE id_estudiante = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  public function actualizar($id, $datos) {
    $stmt = $this->conexion->prepare("UPDATE estudiante SET carnet=?, nombre=?, apellido=?, email=?, estado=?, actualizado_en=NOW() WHERE id_estudiante=?");
    $stmt->bind_param("sssssi", $datos['carnet'], $datos['nombre'], $datos['apellido'], $datos['email'], $datos['estado'], $id);
    return $stmt->execute();
  }

  public function eliminar($id) {
    $stmt = $this->conexion->prepare("DELETE FROM estudiante WHERE id_estudiante = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }

  public function carnetExiste($carnet) {
    $stmt = $this->conexion->prepare("SELECT id_estudiante FROM estudiante WHERE carnet = ?");
    $stmt->bind_param("s", $carnet);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->num_rows > 0;
  }
}
