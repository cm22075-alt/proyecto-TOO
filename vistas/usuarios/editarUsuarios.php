<h2><?= $titulo ?></h2>
<form method="POST">
  <label>Username:</label>
  <input type="text" name="username" value="<?= $usuario['username'] ?>" required><br>

  <label>Rol:</label>
  <select name="rol">
    <option value="administrador" <?= $usuario['rol'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
    <option value="tutor" <?= $usuario['rol'] == 'tutor' ? 'selected' : '' ?>>Tutor</option>
    <option value="coordinador" <?= $usuario['rol'] == 'coordinador' ? 'selected' : '' ?>>Coordinador</option>
    <option value="estudiante" <?= $usuario['rol'] == 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
  </select><br>

  <label>Estado:</label>
  <select name="estado">
    <option value="activo" <?= $usuario['estado'] == 'activo' ? 'selected' : '' ?>>Activo</option>
    <option value="inactivo" <?= $usuario['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
  </select><br>

  <button type="submit">Actualizar</button>
</form>
