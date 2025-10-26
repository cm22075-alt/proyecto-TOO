<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php');
if (!isset($asignaturas)) {
  echo "<p style='color:red;'>Error: la variable \$asignaturas no está definida.</p>";
  return;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asignaturas</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
</head>

<body>
<section class="seccion-estudiantes">
  <h2>📘 Asignaturas Registradas</h2>
  
  <div class="info-registros">
    <p>📊 Total de asignaturas: <strong><?= $asignaturas->num_rows ?></strong></p>
  </div>

  <div class="acciones-superiores">
    <a class="boton-nuevo" href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=crear">➕ Nueva asignatura</a>
  </div>

  <div class="buscador">
    <input type="text" id="buscarAsignatura" placeholder="🔍 Buscar por código o nombre..." onkeyup="filtrarTabla()">
  </div>

  <table class="tabla-estudiantes">
    <thead>
      <tr>
        <th>ID</th>
        <th>Código</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($asignaturas && $asignaturas->num_rows > 0): ?>
        <?php while ($row = $asignaturas->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id_asignatura'] ?></td>
            <td><?= $row['codigo'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td>
              <span class="badge badge-<?= $row['estado'] ? 'activo' : 'inactivo' ?>">
                <?= $row['estado'] ? '✓ Activo' : '✗ Inactivo' ?>
              </span>
            </td>
            <td class="acciones-celda">
              <a class="accion-editar" href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=editar&id=<?= $row['id_asignatura'] ?>">✏️ Editar</a>
              <a class="accion-eliminar" href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=eliminar&id=<?= $row['id_asignatura'] ?>" onclick="return confirm('¿Eliminar asignatura?')">🗑️ Eliminar</a>
              <a class="accion-<?= $row['estado'] ? 'desactivar' : 'activar' ?>" href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=cambiarEstado&id=<?= $row['id_asignatura'] ?>">
                <?= $row['estado'] ? '🔒 Desactivar' : '🔓 Activar' ?>
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5">No hay asignaturas registradas.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>

<script>
function filtrarTabla() {
  const input = document.getElementById('buscarAsignatura');
  const filtro = input.value.toUpperCase();
  const tabla = document.querySelector('.tabla-estudiantes tbody');
  const filas = tabla.getElementsByTagName('tr');
  
  for (let i = 0; i < filas.length; i++) {
    const codigo = filas[i].getElementsByTagName('td')[1];
    const nombre = filas[i].getElementsByTagName('td')[2];
    if (codigo && nombre) {
      const textocodigo = codigo.textContent || codigo.innerText;
      const textonombre = nombre.textContent || nombre.innerText;
      if (textocodigo.toUpperCase().indexOf(filtro) > -1 || textonombre.toUpperCase().indexOf(filtro) > -1) {
        filas[i].style.display = '';
      } else {
        filas[i].style.display = 'none';
      }
    }
  }
}
</script>
</body>
</html>