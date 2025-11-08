<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Estudiante</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilos.css">
</head>

<body>
<section class="formulario-estudiante">
<h2 class="titulo-formulario">✏️ Editar Estudiante</h2>
<form class="formulario-estudiante" method="POST" action="<?= BASE_URL ?>/estudiantes/editar/?id=<?= $estudiante['id_estudiante'] ?>">
  <label>Carnet:</label>
  <input type="text" name="carnet" value="<?= $estudiante['carnet'] ?>" required>

  <label>Nombre:</label>
  <input type="text" name="nombre" value="<?= $estudiante['nombre'] ?>" required>

  <label>Apellido:</label>
  <input type="text" name="apellido" value="<?= $estudiante['apellido'] ?>" required>

  <label>Email:</label>
  <input type="email" name="email" value="<?= $estudiante['email'] ?>" required>

  <label>Estado:</label>
  <select name="estado">
    <option value="1" <?= $estudiante['estado'] ? 'selected' : '' ?>>Activo</option>
    <option value="0" <?= !$estudiante['estado'] ? 'selected' : '' ?>>Inactivo</option>
  </select>

  <div class="botones-formulario">
    <button type="submit" class="boton-guardar">Actualizar</button>
    <a href="<?= BASE_URL ?>/estudiantes" class="boton-volver">Cancelar</a>
  </div>
</form>
</section>
</body>
</html>
