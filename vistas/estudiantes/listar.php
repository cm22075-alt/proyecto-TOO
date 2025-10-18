<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Estudiantes</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
</head>
<a href="/proyecto-TOO/index.php" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
  🏠 Volver al inicio
</a>

<body>
  <h2>Estudiantes Registrados</h2>
  <a href="../index.php?modulo=estudiantes&accion=crear">➕ Nuevo estudiante</a>
<table border="1">
  <tr>
    <th>ID</th><th>Carnet</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Estado</th><th>Acciones</th>
  </tr>
    <?php if ($estudiantes && $estudiantes->num_rows > 0): ?>
      <?php while ($e = $estudiantes->fetch_assoc()): ?>
    <tr>
      <td><?= $e['id_estudiante'] ?></td>
      <td><?= $e['carnet'] ?></td>
      <td><?= $e['nombre'] ?></td>
      <td><?= $e['apellido'] ?></td>
      <td><?= $e['email'] ?></td>
      <td><?= $e['estado'] ?></td>
      <td>
        <a href="../index.php?modulo=estudiantes&accion=editar&id=<?= $e['id_estudiante'] ?>">✏️</a>
        <a href="../index.php?modulo=estudiantes&accion=eliminar&id=<?= $e['id_estudiante'] ?>" onclick="return confirm('¿Eliminar?')">🗑️</a>
      </td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr><td colspan="6">No hay estudiantes registrados.</td></tr>
<?php endif; ?>
  </table>
</body>
</html>
