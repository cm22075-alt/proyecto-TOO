<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php
include_once(dirname(__DIR__, 2) . '/config/db.php');
if (!isset($estudiantes)) {
  echo "<p style='color:red;'>Error: la variable \$estudiantes no está definida. Asegúrate de acceder desde el controlador.</p>";
  return;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Estudiantes</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
</head>

<body>
  <h2>Estudiantes Registrados</h2>
  <a href="?= BASE_URL ?>/index.php?modulo=estudiantes&accion=crear">➕ Nuevo estudiante</a>
<table border="1">
  <tr>
    <th>ID</th><th>Carnet</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Estado</th><th>Acciones</th>
  </tr>
    <?php if ($estudiantes && $estudiantes->num_rows > 0): ?>
      <?php while ($row = $estudiantes->fetch_assoc()) : ?>
    <tr>
      <td><?= $row['id_estudiante'] ?></td>
      <td><?= $row['carnet'] ?></td>
      <td><?= $row['nombre'] ?></td>
      <td><?= $row['apellido'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?= $row['estado'] ? 'Activo' : 'Inactivo' ?></td>
      <td>
        <a href="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=editar&id=<?= $row['id_estudiante'] ?>">Editar</a> |
        <a href="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=eliminar&id=<?= $row['id_estudiante'] ?>" onclick="return confirm('¿Eliminar estudiante?')">Eliminar</a>
      </td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr><td colspan="6">No hay estudiantes registrados.</td></tr>
<?php endif; ?>
  </table>
</body>
</html>
