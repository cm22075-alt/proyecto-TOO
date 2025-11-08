<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Usuarios</title>
  
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
</head>

<div class="form-container">
  <h2 class="form-title"><?= $titulo ?></h2>
  <form method="POST" class="form-box">
    <div class="form-group">
      <label for="username">Usuario:</label>
      <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
      <label for="rol">Rol:</label>
      <select id="rol" name="rol">
        <option value="administrador">Administrador</option>
        <option value="tutor">Tutor</option>
        <option value="coordinador">Coordinador</option>
        <option value="estudiante">Estudiante</option>
      </select>
    </div>

    <div class="form-group">
      <label for="estado">Estado:</label>
      <select id="estado" name="estado">
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
      </select>
    </div>

    <div class="form-submit">
      <button type="submit" class="btn-primary">Guardar</button>
      <a href="<?= BASE_URL ?>/usuarios" class="btn-cancelar">Cancelar</a>
    </div>
  </form>
</div>
