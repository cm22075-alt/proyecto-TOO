<?php
require_once("Config/db.php");

if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

try {
    // --- Usuarios base ---
    $usuarios = [
        ['Tutor123', '123456', 'Tutor'],
        ['Estudiante', '123456', 'Estud']
    ];

    // --- Sentencia SQL ---
    $stmt = $conexion->prepare("INSERT INTO usuario (username, password_hash, rol, estado, creado_en) VALUES (?, ?, ?, 1, NOW())");

    foreach ($usuarios as $u) {
        // Hashear contraseña
        $password_hash = password_hash($u[1], PASSWORD_DEFAULT);

        // Ejecutar inserción
        $stmt->bind_param("sss", $u[0], $password_hash, $u[2]);
        $stmt->execute();

        echo "✅ Usuario '{$u[0]}' creado correctamente.<br>";
    }

    $stmt->close();
    $conexion->close();

    echo "<br>🎉 Listo. Ahora puedes iniciar sesión con:<br>";
    echo "👨‍🏫 Tutor123 / 123456<br>";
    echo "🎓 Estudiante / 123456<br>";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
