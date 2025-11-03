<?php
include_once dirname(__DIR__) . '/config/db.php';

class Auditoria {
  private $db;

  public function __construct($conexion) {
    $this->db = $conexion;
  }
  public function registrar($modulo, $accion, $descripcion, $usuario_id) {
    $sql = "INSERT INTO auditoria (modulo, accion, descripcion, usuario_id) VALUES (?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("sssi", $modulo, $accion, $descripcion, $usuario_id);
    $stmt->execute();
  }

    public function listar() {
    $sql = "SELECT a.*, username AS usuario FROM auditoria a JOIN usuario u ON a.usuario_id = u.id_usuario ORDER BY fecha DESC";
    return $this->db->query($sql);
    }

}