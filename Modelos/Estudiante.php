<?php
include_once dirname(__DIR__) . '/config/db.php';

class Estudiante {
  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function crear($datos) {
    $stmt = $this->conexion->prepare(
      "INSERT INTO estudiante (carnet, nombre, apellido, email) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $datos['carnet'], $datos['nombre'], $datos['apellido'], $datos['email']);
    return $stmt->execute();
  }

  public function listar() {
    $sql = "SELECT * FROM estudiante WHERE estado = 1 ORDER BY creado_en DESC";
    $resultado = $this->conexion->query($sql);
    return $resultado ?: null;
  }

  public function carnetExiste($carnet) {
    $stmt = $this->conexion->prepare("SELECT id_estudiante FROM estudiante WHERE carnet = ?");
    $stmt->bind_param("s", $carnet);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->num_rows > 0;
  }
}
