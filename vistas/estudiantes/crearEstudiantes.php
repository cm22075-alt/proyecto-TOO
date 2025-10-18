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
<h2>Crear Estudiante</h2>
<form method="POST" action="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=crear">
  Carnet: <input type="text" name="carnet"><br>
  Nombre: <input type="text" name="nombre"><br>
  Apellido: <input type="text" name="apellido"><br>
  Email: <input type="email" name="email"><br>
  Estado: <select name="estado">
    <option value="1">Activo</option>
    <option value="0">Inactivo</option>
  </select><br>
  <button type="submit">Guardar</button>
</form>
    <a href="../index.php?modulo=estudiantes&accion=listar">← Volver</a>
</body>
</html>
