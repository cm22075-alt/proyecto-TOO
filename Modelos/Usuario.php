<?php
require_once dirname(__DIR__) . '/config/db.php';

class Usuario {
    private $db;

    public function __construct() {
        global $conexion;
        $this->db = $conexion;
    }

    public function listar() {
        $sql = "SELECT * FROM usuario";
        return $this->db->query($sql);
    }

    public function crear($username, $password, $rol, $estado) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuario (username, password_hash, rol, estado, creado_en, actualizado_en) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("ssss", $username, $hash, $rol, $estado);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizar($id, $username, $rol, $estado) {
        $stmt = $this->db->prepare("UPDATE usuario SET username = ?, rol = ?, estado = ?, actualizado_en = NOW() WHERE id_usuario = ?");
        $stmt->bind_param("sssi", $username, $rol, $estado, $id);
        return $stmt->execute();
    }
}
