<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sesiones Registradas</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<section class="tabla-sesion">
  <h2>📋 Sesiones Registradas</h2>

  <form method="POST" class="filtros-reporte">
    <label>Desde: <input type="date" name="fecha_inicio" value="<?= $fechaInicio ?>"></label>
    <label>Hasta: <input type="date" name="fecha_fin" value="<?= $fechaFin ?>"></label>

    <label>Tutor:
      <select name="id_tutor">
        <option value="">Todos</option>
        <?php
        $tutores = $conexion->query("SELECT id_tutor, nombre FROM tutor ORDER BY nombre");
        while ($t = $tutores->fetch_assoc()) {
          $sel = ($idTutor == $t['id_tutor']) ? 'selected' : '';
          echo "<option value='{$t['id_tutor']}' $sel>{$t['nombre']}</option>";
        }
        ?>
      </select>
    </label>

    <label>Asignatura:
      <select name="id_asignatura">
        <option value="">Todas</option>
        <?php
        $asignaturas = $conexion->query("SELECT id_asignatura, nombre FROM asignatura ORDER BY nombre");
        while ($a = $asignaturas->fetch_assoc()) {
          $sel = ($idAsignatura == $a['id_asignatura']) ? 'selected' : '';
          echo "<option value='{$a['id_asignatura']}' $sel>{$a['nombre']}</option>";
        }
        ?>
      </select>
    </label>

    <button type="submit">🔍 Consultar</button>
    <a href="<?= BASE_URL ?>/index.php?modulo=sesion&accion=crear" class="boton-agregar">➕ Nueva sesión</a>
  </form>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Estudiante</th>
        <th>Asignatura</th>
        <th>Tutor</th>
        <th>Fecha y hora</th>
        <th>Observaciones</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; while ($s = $sesiones->fetch_assoc()): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= $s['estudiante'] ?></td>
          <td><?= $s['asignatura'] ?></td>
          <td><?= $s['tutor'] ?></td>
          <td><?= date('d/m/Y H:i', strtotime($s['fecha_hora'])) ?></td>
          <td><?= $s['observaciones'] ?></td>
          <td>
            <a href="<?= BASE_URL ?>/index.php?modulo=sesion&accion=editar&id=<?= $s['id_sesion'] ?>" class="boton-editar">✏️</a>
            <a href="<?= BASE_URL ?>/index.php?modulo=sesion&accion=eliminar&id=<?= $s['id_sesion'] ?>" class="boton-eliminar" onclick="return confirm('¿Eliminar esta sesión?')">🗑️</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <?php if (!empty($reporte) && $reporte->num_rows > 0): ?>
    <h3>📊 Resumen por estudiante</h3>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Estudiante</th>
          <th>Total sesiones</th>
          <th>Promedio por día</th>
          <th>Nivel</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $i = 1;
          $top = [];
          $labels = [];
          $valores = [];
          $reporte->data_seek(0);
          while ($r = $reporte->fetch_assoc()):
            $nivel = $r['total_sesiones'] >= 7 ? 'Alto' : ($r['total_sesiones'] >= 4 ? 'Medio' : 'Bajo');
            if ($i <= 3) $top[] = "{$r['estudiante']} ({$r['total_sesiones']} sesiones)";
            $labels[] = $r['estudiante'];
            $valores[] = $r['total_sesiones'];
        ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $r['estudiante'] ?></td>
            <td><?= $r['total_sesiones'] ?></td>
            <td><?= $r['promedio'] ?></td>
            <td><?= $nivel ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <h4>📌 Top <?= count($top) ?> estudiantes con más sesiones:</h4>
    <ul>
      <?php foreach ($top as $t): ?>
        <li><?= $t ?></li>
      <?php endforeach; ?>
    </ul>

    <form method="POST" action="exportarSesionesCSV.php" target="_blank">
      <input type="hidden" name="fecha_inicio" value="<?= $fechaInicio ?>">
      <input type="hidden" name="fecha_fin" value="<?= $fechaFin ?>">
      <input type="hidden" name="id_tutor" value="<?= $idTutor ?>">
      <input type="hidden" name="id_asignatura" value="<?= $idAsignatura ?>">
      <button type="submit">📁 Exportar a CSV</button>
    </form>

    <canvas id="graficoSesiones" width="800" height="300" style="margin-top: 30px;"></canvas>
    <script>
      const ctx = document.getElementById('graficoSesiones').getContext('2d');
      const chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?= json_encode($labels) ?>,
          datasets: [{
            label: 'Total de sesiones',
            data: <?= json_encode($valores) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { display: false },
            title: { display: true, text: 'Sesiones por estudiante' }
          }
        }
      });
    </script>
  <?php endif; ?>
</section>
</body>
</html>
