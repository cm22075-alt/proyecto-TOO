<?php // código temporal en lo que se agrega el de la historia de usuario 2
class Tutor {
  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function listar() {
    $sql = "SELECT * FROM tutor ORDER BY id_tutor DESC";
    return $this->conexion->query($sql);
  }

  public function crear($data) {
    $codigo = $this->conexion->real_escape_string($data['codigo']);
    $nombre = $this->conexion->real_escape_string($data['nombre']);
    $apellido = $this->conexion->real_escape_string($data['apellido']);
    $email = $this->conexion->real_escape_string($data['email']);
    $especialidad = $this->conexion->real_escape_string($data['especialidad'] ?? '');

    $check = $this->conexion->query("SELECT * FROM tutor WHERE codigo='$codigo'");
    if ($check->num_rows > 0) {
      return "El código ya existe.";
    }

    $check = $this->conexion->query("SELECT * FROM tutor WHERE email='$email'");
    if ($check->num_rows > 0) {
      return "El email ya existe.";
    }

    $sql = "INSERT INTO tutor (codigo, nombre, apellido, email, especialidad, estado) 
            VALUES ('$codigo', '$nombre', '$apellido', '$email', '$especialidad', 1)";
    return $this->conexion->query($sql);
  }

  public function obtener($id) {
    $sql = "SELECT * FROM tutor WHERE id_tutor = $id";
    return $this->conexion->query($sql)->fetch_assoc();
  }

  public function actualizar($id, $data) {
    $codigo = $this->conexion->real_escape_string($data['codigo']);
    $nombre = $this->conexion->real_escape_string($data['nombre']);
    $apellido = $this->conexion->real_escape_string($data['apellido']);
    $email = $this->conexion->real_escape_string($data['email']);
    $especialidad = $this->conexion->real_escape_string($data['especialidad'] ?? '');

    $check = $this->conexion->query("SELECT * FROM tutor WHERE codigo='$codigo' AND id_tutor != $id");
    if ($check->num_rows > 0) {
      return "El código ya existe en otro tutor.";
    }

    $check = $this->conexion->query("SELECT * FROM tutor WHERE email='$email' AND id_tutor != $id");
    if ($check->num_rows > 0) {
      return "El email ya existe en otro tutor.";
    }

    $sql = "UPDATE tutor 
            SET codigo='$codigo', nombre='$nombre', apellido='$apellido', 
                email='$email', especialidad='$especialidad' 
            WHERE id_tutor=$id";
    return $this->conexion->query($sql);
  }

  public function eliminar($id) {
    $sql = "DELETE FROM tutor WHERE id_tutor=$id";
    return $this->conexion->query($sql);
  }

  public function cambiarEstado($id) {
    $res = $this->conexion->query("SELECT estado FROM tutor WHERE id_tutor=$id");
    $fila = $res->fetch_assoc();
    $nuevoEstado = $fila['estado'] ? 0 : 1;
    $this->conexion->query("UPDATE tutor SET estado=$nuevoEstado WHERE id_tutor=$id");
  }
}
?>
