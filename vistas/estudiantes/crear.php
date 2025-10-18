<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Estudiante</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
</head>
<body>
  <h2>Registrar Estudiante</h2>
  <h2><?= isset($estudiante) ? 'Editar' : 'Crear' ?> estudiante</h2>
  <form method="POST" action="/proyecto-TOO/index.php?modulo=estudiantes&accion=crear">
    <input name="carnet" placeholder="Carnet" value="<?= $estudiante['carnet'] ?? '' ?>"><br>
    <input name="nombre" placeholder="Nombre" value="<?= $estudiante['nombre'] ?? '' ?>"><br>
    <input name="apellido" placeholder="Apellido" value="<?= $estudiante['apellido'] ?? '' ?>"><br>
    <input name="email" placeholder="Email" value="<?= $estudiante['email'] ?? '' ?>"><br>
    <select name="estado">
      <option value="activo" <?= ($estudiante['estado'] ?? '') === 'activo' ? 'selected' : '' ?>>Activo</option>
      <option value="inactivo" <?= ($estudiante['estado'] ?? '') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
    </select><br>
    <button type="submit">Guardar</button>
  </form>
    <a href="../index.php?modulo=estudiantes&accion=listar">← Volver</a>
</body>
</html>
