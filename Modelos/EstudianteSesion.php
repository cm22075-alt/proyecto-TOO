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
                s.id_sesion,
                CONCAT(e.nombre, ' ', e.apellido) AS estudiante,
                a.nombre AS asignatura,
                CONCAT(t.nombre, ' ', t.apellido) AS tutor,
                DATE_FORMAT(s.fecha_hora, '%d/%m/%Y %H:%i') AS fecha_hora,
                s.observaciones
            FROM sesion s
            INNER JOIN estudiante e ON s.id_estudiante = e.id_estudiante
            INNER JOIN asignatura a ON s.id_asignatura = a.id_asignatura
            INNER JOIN tutor t ON s.id_tutor = t.id_tutor
            ORDER BY s.fecha_hora DESC
        ";

        $resultado = $this->db->query($sql);
        if (!$resultado) {
            die("Error al obtener las sesiones: " . $this->db->error);
        }

        return $resultado;
    }
}
