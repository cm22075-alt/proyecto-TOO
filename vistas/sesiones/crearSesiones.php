<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Sesión Grupal</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
</head>

<body>
<section class="formulario-estudiante">
  <h2>Registrar Sesión Grupal</h2>
  <form method="POST" action="<?= BASE_URL ?>/index.php?modulo=sesion&accion=crear">
    
    <label>Asignatura:</label>
    <select name="id_asignatura" required>
      <?php
      $asignaturas = $conexion->query("SELECT id_asignatura, nombre FROM asignatura ORDER BY nombre ASC");
      while ($a = $asignaturas->fetch_assoc()) {
        echo "<option value='{$a['id_asignatura']}'>{$a['nombre']}</option>";
      }
      ?>
    </select>

    <label>Tutor:</label>
    <select name="id_tutor" required>
      <?php
      $tutores = $conexion->query("SELECT id_tutor, nombre FROM tutor ORDER BY nombre ASC");
      while ($t = $tutores->fetch_assoc()) {
        echo "<option value='{$t['id_tutor']}'>{$t['nombre']}</option>";
      }
      ?>
    </select>

    <label>Fecha y hora:</label>
    <input type="datetime-local" name="fecha_hora" required>

    <label>Observaciones:</label>
    <textarea name="observaciones" rows="3"></textarea>

    <label>Estudiantes (selección múltiple):</label>
    <select name="estudiantes[]" multiple required>
      <?php
      $estudiantes = $conexion->query("SELECT id_estudiante, nombre, apellido FROM estudiante ORDER BY nombre ASC");
      while ($e = $estudiantes->fetch_assoc()) {
        echo "<option value='{$e['id_estudiante']}'>{$e['nombre']} {$e['apellido']}</option>";
      }
      ?>
    </select>

    <div class="botones-formulario">
      <button type="submit" class="boton-guardar">Guardar sesión</button>
      <a href="<?= BASE_URL ?>/index.php?modulo=sesion&accion=listar" class="boton-volver">Cancelar</a>
    </div>
  </form>
</section>
</body>
</html>
