<h2 class="titulo-auditoria">📊 Reporte de Sesiones por Estudiante</h2>

<form method="POST" class="filtros-reporte">
  <label>Desde: <input type="date" name="fecha_inicio" value="<?= $fechaInicio ?>"></label>
  <label>Hasta: <input type="date" name="fecha_fin" value="<?= $fechaFin ?>"></label>
  <button type="submit">🔍 Generar reporte</button>
</form>

<?php if (!empty($resultados) && $resultados->num_rows > 0): ?>
  <table class="tabla-estudiantes">
    <thead>
      <tr>
        <th>#</th>
        <th>Estudiante</th>
        <th>Total sesiones</th>
        <th>Promedio sesiones</th>
        <th>Nivel de seguimiento</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $top = [];
        $i = 1;
        while ($row = $resultados->fetch_assoc()):
          $nivel = $row['total_sesiones'] >= 7 ? 'Alto' : ($row['total_sesiones'] >= 4 ? 'Medio' : 'Bajo');
          if ($i <= 3) $top[] = "{$row['estudiante']} ({$row['total_sesiones']} sesiones)";
      ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= $row['estudiante'] ?></td>
          <td><?= $row['total_sesiones'] ?></td>
          <td><?= $row['promedio_sesiones'] ?></td>
          <td><?= $nivel ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <h3>📌 Top <?= count($top) ?> estudiantes con más sesiones:</h3>
  <ul>
    <?php foreach ($top as $t): ?>
      <li><?= $t ?></li>
    <?php endforeach; ?>
  </ul>

  <form method="POST" action="exportarCSV.php" target="_blank">
    <input type="hidden" name="fecha_inicio" value="<?= $fechaInicio ?>">
    <input type="hidden" name="fecha_fin" value="<?= $fechaFin ?>">
    <button type="submit">📁 Exportar a CSV</button>
  </form>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
  <p style="color:red;">No se encontraron resultados para el rango seleccionado.</p>
<?php endif; ?>
