<?php
class Asignatura {
  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function listar() {
    $sql = "SELECT * FROM asignatura ORDER BY id_asignatura DESC";
    return $this->conexion->query($sql);
  }

  public function crear($data) {
    $codigo = $this->conexion->real_escape_string($data['codigo']);
    $nombre = $this->conexion->real_escape_string($data['nombre']);

    $check = $this->conexion->query("SELECT * FROM asignatura WHERE codigo='$codigo'");
    if ($check->num_rows > 0) {
      return "El código ya existe.";
    }

    $sql = "INSERT INTO asignatura (codigo, nombre, estado) VALUES ('$codigo', '$nombre', 1)";
    return $this->conexion->query($sql);
  }

  public function obtener($id) {
    $sql = "SELECT * FROM asignatura WHERE id_asignatura = $id";
    return $this->conexion->query($sql)->fetch_assoc();
  }

  public function actualizar($id, $data) {
    $codigo = $this->conexion->real_escape_string($data['codigo']);
    $nombre = $this->conexion->real_escape_string($data['nombre']);

    $check = $this->conexion->query("SELECT * FROM asignatura WHERE codigo='$codigo' AND id_asignatura != $id");
    if ($check->num_rows > 0) {
      return "El código ya existe en otra asignatura.";
    }

    $sql = "UPDATE asignatura SET codigo='$codigo', nombre='$nombre' WHERE id_asignatura=$id";
    return $this->conexion->query($sql);
  }

  public function eliminar($id) {
    $sql = "DELETE FROM asignatura WHERE id_asignatura=$id";
    return $this->conexion->query($sql);
  }

  public function cambiarEstado($id) {
    $res = $this->conexion->query("SELECT estado FROM asignatura WHERE id_asignatura=$id");
    $fila = $res->fetch_assoc();
    $nuevoEstado = $fila['estado'] ? 0 : 1;
    $this->conexion->query("UPDATE asignatura SET estado=$nuevoEstado WHERE id_asignatura=$id");
  }
}
?>

