<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Estudiante</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
</head>
<body>
<h2>Editar Estudiante</h2>
<form method="POST" action="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=editar&id=<?= $estudiante['id_estudiante'] ?>">
  Carnet: <input type="text" name="carnet" value="<?= $estudiante['carnet'] ?>"><br>
  Nombre: <input type="text" name="nombre" value="<?= $estudiante['nombre'] ?>"><br>
  Apellido: <input type="text" name="apellido" value="<?= $estudiante['apellido'] ?>"><br>
  Email: <input type="email" name="email" value="<?= $estudiante['email'] ?>"><br>
  Estado: <select name="estado">
    <option value="1" <?= $estudiante['estado'] ? 'selected' : '' ?>>Activo</option>
    <option value="0" <?= !$estudiante['estado'] ? 'selected' : '' ?>>Inactivo</option>
  </select><br>
  <button type="submit">Actualizar</button>
</form>
    <a href="../index.php?modulo=estudiantes&accion=listar">← Volver</a>
</body>
</html>
