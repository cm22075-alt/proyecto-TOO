<?php
class AsignaturaEstudiante {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Listar todas las asignaturas (solo lectura)
    public function listar() {
        $sql = "SELECT * FROM asignatura ORDER BY id_asignatura DESC";
        return $this->conexion->query($sql);
    }

    // No incluimos crear, editar, eliminar ni cambiar estado, porque el estudiante solo ve
}
?>
