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
  <a href="../../controladores/EstudiantesController.php?accion=crear">➕ Nuevo Estudiante</a>
  <table>
    <tr>
      <th>ID</th><th>Carnet</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Creado</th>
    </tr>
    <?php if ($estudiantes && $estudiantes->num_rows > 0): ?>
  <?php while ($fila = $estudiantes->fetch_assoc()) : ?>
    <tr>
      <td><?= $fila['id_estudiante'] ?></td>
      <td><?= $fila['carnet'] ?></td>
      <td><?= $fila['nombre'] ?></td>
      <td><?= $fila['apellido'] ?></td>
      <td><?= $fila['email'] ?></td>
      <td><?= $fila['creado_en'] ?></td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr><td colspan="6">No hay estudiantes registrados.</td></tr>
<?php endif; ?>
  </table>
</body>
</html>
