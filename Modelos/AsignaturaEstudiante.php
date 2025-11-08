<?php
// Modelos/AsignaturaEstudiante.php

require_once __DIR__ . '/../Config/db.php';

class AsignaturaEstudiante
{
    private $db;

    public function __construct()
    {
        // Obtener la conexión global definida en db.php
        global $conexion;
        $this->db = $conexion;

        // Validar la conexión
        if ($this->db === null || $this->db->connect_error) {
            die("Error de conexión: La base de datos no está disponible.");
        }
    }

    /**
     * Listar todas las asignaturas activas disponibles para el estudiante.
     * Solo muestra las activas (estado = 1).
     */
    public function listar()
    {
        $sql = "SELECT id_asignatura, codigo, nombre, estado
                FROM asignatura
                WHERE estado = 1
                ORDER BY nombre ASC";

        $resultado = $this->db->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $data = $resultado->fetch_all(MYSQLI_ASSOC);
            $resultado->free();
            return $data;
        }

        // Retornar array vacío si no hay resultados
        return [];
    }
}
