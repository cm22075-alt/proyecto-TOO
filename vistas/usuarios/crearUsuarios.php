<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Usuarios</title>
  
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
</head>

<h2><?= $titulo ?></h2>
<form method="POST">
  <label>Username:</label>
  <input type="text" name="username" required><br>

  <label>Password:</label>
  <input type="password" name="password" required><br>

  <label>Rol:</label>
  <select name="rol">
    <option value="administrador">Administrador</option>
    <option value="tutor">Tutor</option>
    <option value="auditor">Auditor</option>
  </select><br>

  <label>Estado:</label>
  <select name="estado">
    <option value="activo">Activo</option>
    <option value="inactivo">Inactivo</option>
  </select><br>

  <button type="submit">Guardar</button>
  
</form>
