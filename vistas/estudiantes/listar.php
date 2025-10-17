<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Estudiantes</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
</head>
<body>
  <h2>Estudiantes Registrados</h2>
  <a href="../../controladores/EstudianteControlador.php?accion=crear">➕ Nuevo Estudiante</a>
  <table>
    <tr>
      <th>ID</th><th>Carnet</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Creado</th>
    </tr>
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
  </table>
</body>
</html>
