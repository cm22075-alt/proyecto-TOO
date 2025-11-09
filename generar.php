<?php
require_once("Config/db.php");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

try {

    // --- Lista de usuarios que quieres insertar ---
    $usuarios = [
        ['tutor02', 'tutor123', 'Tutor'],
        ['estu01', '12345', 'Estudiante'] // <- ejemplo estudiante
    ];

    // --- Sentencia SQL (tabla en singular) ---
    $stmt = $conexion->prepare("INSERT INTO usuario (username, password_hash, rol, estado, creado_en) VALUES (?, ?, ?, 1, NOW())");

    foreach ($usuarios as $u) {
        $password_hash = password_hash($u[1], PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $u[0], $password_hash, $u[2]);
        $stmt->execute();
        echo "✅ Usuario '{$u[0]}' creado correctamente.<br>";
    }

    $stmt->close();
    $conexion->close();

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
