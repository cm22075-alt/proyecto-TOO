<?php
$contrasena = '123456';
$hash_generado = password_hash($contrasena, PASSWORD_DEFAULT);

echo "Contraseña en plano: " . $contrasena . "<br>";
echo "Nuevo Hash generado: " . $hash_generado . "<br>";
?>