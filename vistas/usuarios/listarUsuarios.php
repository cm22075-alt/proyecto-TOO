<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
</head>
<body>

<div class="usuarios-container">
  <h2 class="titulo-seccion"><?= $titulo ?></h2>
  <div class="acciones-superiores">
    <a href="<?= BASE_URL ?>/usuarios/crear" class="btn-agregar">Crear nuevo usuario</a>
  </div>

  <table class="tabla-usuarios">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Rol</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($u = $registros->fetch_assoc()): ?>
      <tr>
        <td><?= $u['id_usuario'] ?></td>
        <td><?= $u['username'] ?></td>
        <td><?= $u['rol'] ?></td>
        <td><?= $u['estado'] == 1 ? 'Activo' : 'Inactivo' ?></td>
        <td>
          <a href="<?= BASE_URL ?>/usuarios/editar?id=<?= $u['id_usuario'] ?>" class="btn-editar">Editar</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>

