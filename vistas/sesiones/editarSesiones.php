<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Sesión</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
</head>

<body>
<section class="formulario-estudiante">
  <h2>✏️ Editar Sesión</h2>
  <form method="POST" action="<?= BASE_URL ?>/index.php?modulo=sesion&accion=editar&id=<?= $sesion['id_sesion'] ?>">

    <label>Estudiante:</label>
    <select name="id_estudiante" required>
      <?php
      $estudiantes = $conexion->query("SELECT id_estudiante, nombre, apellido FROM estudiante ORDER BY nombre ASC");
      while ($e = $estudiantes->fetch_assoc()) {
        $selected = $e['id_estudiante'] == $sesion['id_estudiante'] ? 'selected' : '';
        echo "<option value='{$e['id_estudiante']}' $selected>{$e['nombre']} {$e['apellido']}</option>";
      }
      ?>
    </select>

    <label>Asignatura:</label>
    <select name="id_asignatura" required>
      <?php
      $asignaturas = $conexion->query("SELECT id_asignatura, nombre FROM asignatura ORDER BY nombre ASC");
      while ($a = $asignaturas->fetch_assoc()) {
        $selected = $a['id_asignatura'] == $sesion['id_asignatura'] ? 'selected' : '';
        echo "<option value='{$a['id_asignatura']}' $selected>{$a['nombre']}</option>";
      }
      ?>
    </select>

    <label>Tutor:</label>
    <select name="id_tutor" required>
      <?php
      $tutores = $conexion->query("SELECT id_tutor, nombre FROM tutor ORDER BY nombre ASC");
      while ($t = $tutores->fetch_assoc()) {
        $selected = $t['id_tutor'] == $sesion['id_tutor'] ? 'selected' : '';
        echo "<option value='{$t['id_tutor']}' $selected>{$t['nombre']}</option>";
      }
      ?>
    </select>

    <label>Fecha y hora:</label>
    <input type="datetime-local" name="fecha_hora" value="<?= date('Y-m-d\TH:i', strtotime($sesion['fecha_hora'])) ?>" required>

    <label>Observaciones:</label>
    <textarea name="observaciones" rows="3"><?= $sesion['observaciones'] ?></textarea>

    <div class="botones-formulario">
      <button type="submit" class="boton-guardar">Guardar cambios</button>
      <a href="<?= BASE_URL ?>/index.php?modulo=sesion&accion=listar" class="boton-volver">Cancelar</a>
    </div>
  </form>
</section>
</body>
</html>
