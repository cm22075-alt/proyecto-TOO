<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/Config/db.php');
if (!isset($tutores)) {
  echo "<p style='color:red;'>Error: la variable \$tutores no está definida.</p>";
  return;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tutores</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/Publico/recursos/estilo.css">
</head>

<body>
<section class="seccion-estudiantes">
  <h2>👨‍🏫 Tutores Registrados</h2>
  
  <div class="info-registros">
    <p>📊 Total de tutores: <strong><?= $tutores->num_rows ?></strong></p>
  </div>

  <div class="acciones-superiores">
    <a class="boton-nuevo" href="<?= BASE_URL ?>/index.php?modulo=tutores&accion=crear">➕ Nuevo tutor</a>
    <a class="boton-nuevo" href="<?= BASE_URL ?>/index.php?modulo=reporteTutor&accion=filtro" style="background-color: #9b59b6;">📊 Reporte por Tutor</a>
  </div>

  <div class="buscador">
    <input type="text" id="buscarTutor" placeholder="🔍 Buscar por código, nombre o email..." onkeyup="filtrarTabla()">
  </div>

  <table class="tabla-estudiantes">
    <thead>
      <tr>
        <th>ID</th>
        <th>Código</th>
        <th>Nombre Completo</th>
        <th>Email</th>
        <th>Especialidad</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($tutores && $tutores->num_rows > 0): ?>
        <?php while ($row = $tutores->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id_tutor'] ?></td>
            <td><?= htmlspecialchars($row['codigo']) ?></td>
            <td><?= htmlspecialchars($row['nombre'] . ' ' . $row['apellido']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['especialidad'] ?? '-') ?></td>
            <td>
              <span class="badge badge-<?= $row['estado'] ? 'activo' : 'inactivo' ?>">
                <?= $row['estado'] ? '✓ Activo' : '✗ Inactivo' ?>
              </span>
            </td>
            <td class="acciones-celda">
              <a class="accion-editar" href="<?= BASE_URL ?>/index.php?modulo=tutores&accion=editar&id=<?= $row['id_tutor'] ?>">✏️ Editar</a>
              <a class="accion-eliminar" href="<?= BASE_URL ?>/index.php?modulo=tutores&accion=eliminar&id=<?= $row['id_tutor'] ?>" onclick="return confirm('¿Eliminar tutor?')">🗑️ Eliminar</a>
              <a class="accion-<?= $row['estado'] ? 'desactivar' : 'activar' ?>" href="<?= BASE_URL ?>/index.php?modulo=tutores&accion=cambiarEstado&id=<?= $row['id_tutor'] ?>">
                <?= $row['estado'] ? '🔒 Desactivar' : '🔓 Activar' ?>
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7">No hay tutores registrados.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>

<script>
function filtrarTabla() {
  const input = document.getElementById('buscarTutor');
  const filtro = input.value.toUpperCase();
  const tabla = document.querySelector('.tabla-estudiantes tbody');
  const filas = tabla.getElementsByTagName('tr');
  
  for (let i = 0; i < filas.length; i++) {
    const codigo = filas[i].getElementsByTagName('td')[1];
    const nombre = filas[i].getElementsByTagName('td')[2];
    const email = filas[i].getElementsByTagName('td')[3];
    
    if (codigo && nombre && email) {
      const textoCodigo = codigo.textContent || codigo.innerText;
      const textoNombre = nombre.textContent || nombre.innerText;
      const textoEmail = email.textContent || email.innerText;
      
      if (textoCodigo.toUpperCase().indexOf(filtro) > -1 || 
          textoNombre.toUpperCase().indexOf(filtro) > -1 ||
          textoEmail.toUpperCase().indexOf(filtro) > -1) {
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