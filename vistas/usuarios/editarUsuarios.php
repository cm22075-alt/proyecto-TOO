<div class="form-container">
  <h2 class="form-title"><?= $titulo ?></h2>
  <form method="POST" class="form-box">
    <div class="form-group">
      <label for="username">Usuario:</label>
      <input type="text" id="username" name="username" value="<?= $usuario['username'] ?>" required>
    </div>

    <div class="form-group">
      <label for="rol">Rol:</label>
      <select id="rol" name="rol">
        <option value="administrador" <?= $usuario['rol'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
        <option value="tutor" <?= $usuario['rol'] == 'tutor' ? 'selected' : '' ?>>Tutor</option>
        <option value="coordinador" <?= $usuario['rol'] == 'coordinador' ? 'selected' : '' ?>>Coordinador</option>
        <option value="estudiante" <?= $usuario['rol'] == 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
      </select>
    </div>

    <div class="form-group">
      <label for="estado">Estado:</label>
      <select id="estado" name="estado">
        <option value="activo" <?= $usuario['estado'] == 'activo' ? 'selected' : '' ?>>Activo</option>
        <option value="inactivo" <?= $usuario['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
      </select>
    </div>

    <div class="form-submit">
      <button type="submit" class="btn-primary">Actualizar</button>
      <a href="<?= BASE_URL ?>/usuarios" class="btn-cancelar">Cancelar</a>
    </div>
  </form>
</div>
