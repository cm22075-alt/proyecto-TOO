<?php
// Modelos/Asignatura.php

require_once __DIR__ . '/../Config/db.php';

class Asignatura
{
    private $db;

    public function __construct()
    {
        // 1. Obtener la conexión global
        global $conexion;
        $this->db = $conexion;

        if ($this->db === null || $this->db->connect_error) {
            die("Error de conexión: La base de datos no está disponible.");
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM asignatura ORDER BY nombre ASC";
        $resultado = $this->db->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $data = $resultado->fetch_all(MYSQLI_ASSOC);
            $resultado->free();
            return $data; 
        }
        return [];
    }

    public function crear($data)
    {
        // Usamos real_escape_string (aunque sentencias preparadas son mejores, seguimos tu estilo)
        $codigo = $this->db->real_escape_string($data['codigo']);
        $nombre = $this->db->real_escape_string($data['nombre']);

        $check = $this->db->query("SELECT * FROM asignatura WHERE codigo='$codigo'");
        if ($check->num_rows > 0) {
            return "El código ya existe.";
        }

        $sql = "INSERT INTO asignatura (codigo, nombre, estado) VALUES ('$codigo', '$nombre', 1)";
        return $this->db->query($sql);
    }

    public function obtener($id)
    {
        $sql = "SELECT * FROM asignatura WHERE id_asignatura = " . (int)$id;
        $res = $this->db->query($sql);
        return $res ? $res->fetch_assoc() : null;
    }

    public function actualizar($id, $data)
    {
        $codigo = $this->db->real_escape_string($data['codigo']);
        $nombre = $this->db->real_escape_string($data['nombre']);

        $check = $this->db->query("SELECT * FROM asignatura WHERE codigo='$codigo' AND id_asignatura != $id");
        if ($check->num_rows > 0) {
            return "El código ya existe en otra asignatura.";
        }

        $sql = "UPDATE asignatura SET codigo='$codigo', nombre='$nombre' WHERE id_asignatura=" . (int)$id;
        return $this->db->query($sql);
    }

    public function eliminar($id)
    {
        // Usamos eliminación física por simplicidad
        $sql = "DELETE FROM asignatura WHERE id_asignatura=" . (int)$id;
        return $this->db->query($sql);
    }

    public function cambiarEstado($id)
    {
        $res = $this->db->query("SELECT estado FROM asignatura WHERE id_asignatura=" . (int)$id);
        $fila = $res->fetch_assoc();
        $nuevoEstado = $fila['estado'] ? 0 : 1;
        $this->db->query("UPDATE asignatura SET estado=$nuevoEstado WHERE id_asignatura=" . (int)$id);
    }
}