<?php



if (!isset($asignaturas)) {
  echo "<p style='color:red;'>Error: la variable \$asignaturas no está definida.</p>";
  return;
}
?>

<section class="seccion-estudiantes">
  <h2>📘 Asignaturas del Estudiante</h2>
  
  <div class="info-registros">
    <p>📊 Total de asignaturas: <strong><?= count($asignaturas) ?></strong></p>
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
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($asignaturas)): ?>
        <?php foreach ($asignaturas as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['id_asignatura']) ?></td>
            <td><?= htmlspecialchars($row['codigo']) ?></td>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td>
              <span class="badge <?= $row['estado'] ? 'badge-activo' : 'badge-inactivo' ?>">
                <?= $row['estado'] ? '✓ Activo' : '✗ Inactivo' ?>
              </span>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="4">No hay asignaturas registradas.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>

<script>
function filtrarTabla() {
  const input = document.getElementById('buscarAsignatura');
  const filtro = (input.value || '').toUpperCase();
  const filas = document.querySelectorAll('.tabla-estudiantes tbody tr');

  filas.forEach(fila => {
    const codigo = (fila.cells[1]?.textContent || '').toUpperCase();
    const nombre = (fila.cells[2]?.textContent || '').toUpperCase();
    fila.style.display = (codigo.includes(filtro) || nombre.includes(filtro)) ? '' : 'none';
  });
}
</script>
