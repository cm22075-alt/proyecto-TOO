<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Estudiante</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
</head>

<body>
<section class="formulario-estudiante">
  <h2>Registrar Estudiante</h2>
  <form method="POST" action="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=crear">
    <label>Carnet:</label>
    <input type="text" name="carnet" required>

    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Apellido:</label>
    <input type="text" name="apellido" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Estado:</label>
    <select name="estado">
      <option value="1">Activo</option>
      <option value="0">Inactivo</option>
    </select>

    <div class="botones-formulario">
      <button type="submit" class="boton-guardar">Guardar</button>
      <a href="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=listar" class="boton-volver">← Volver</a>
    </div>
  </form>
</section>
</body>
</html>
