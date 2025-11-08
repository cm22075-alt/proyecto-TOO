<?php
require_once("Config/db.php");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

try {

    $usuarios = [
      
        ['tutor02', 'tutor123', 'Tutor']

    ];

    $stmt = $conexion->prepare("INSERT INTO usuario (username, password_hash, rol, estado) VALUES (?, ?, ?, 1)");

    foreach ($usuarios as $u) {
        $password_hash = password_hash($u[1], PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $u[0], $password_hash, $u[2]);
        $stmt->execute();
    }

    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>