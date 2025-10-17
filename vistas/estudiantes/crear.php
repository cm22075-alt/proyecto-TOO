<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Estudiante</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
</head>
<body>
  <h2>Registrar Estudiante</h2>
  <form method="POST" action="../../controladores/EstudianteControlador.php?accion=crear">
    <input type="text" name="carnet" placeholder="Carnet" required>
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellido" placeholder="Apellido" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="submit" value="Registrar">
  </form>
  <script src="../../publico/recursos/script.js"></script>
</body>
</html>
