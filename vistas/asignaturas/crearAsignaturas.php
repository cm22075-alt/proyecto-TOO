<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Nueva Asignatura</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
</head>

<body>
<section class="formulario-estudiante">
  <h2>➕ Registrar Nueva Asignatura</h2>
  
  <?php if (isset($error)): ?>
    <div class="mensaje-error">
      <strong>⚠️ Error:</strong> <?= $error ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=crear">
    <div class="campo-formulario">
      <label>📝 Código de la asignatura:</label>
      <input type="text" name="codigo" placeholder="Ej: MAT101" required>
    </div>

    <div class="campo-formulario">
      <label>📚 Nombre de la asignatura:</label>
      <input type="text" name="nombre" placeholder="Ej: Matemática I" required>
    </div>

    <div class="botones-formulario">
      <button type="submit" class="boton-guardar">💾 Guardar</button>
      <a href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=listar" class="boton-volver">↩️ Volver</a>
    </div>
  </form>
</section>
</body>
</html>