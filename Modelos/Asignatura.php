<?php
class Asignatura {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM asignatura";
        $resultado = $this->conn->query($sql);
        $asignaturas = [];
        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $asignaturas[] = $fila;
            }
        }
        return $asignaturas;
    }

    public function crear($codigo, $nombre) {
        $sql = "INSERT INTO asignatura (codigo, nombre) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $codigo, $nombre);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM asignatura WHERE id_asignatura = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizar($id, $codigo, $nombre, $estado) {
        $sql = "UPDATE asignatura SET codigo = ?, nombre = ?, estado = ? WHERE id_asignatura = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $codigo, $nombre, $estado, $id);
        return $stmt->execute();
    }

    public function cambiarEstado($id, $estado) {
        $sql = "UPDATE asignatura SET estado = ? WHERE id_asignatura = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $estado, $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM asignatura WHERE id_asignatura = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
