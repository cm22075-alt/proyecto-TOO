<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $titulo ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/Publico/recursos/estilo.css">
  <style>
    .estadisticas-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin: 20px 0;
    }
    
    .estadistica-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .estadistica-card h3 {
      margin: 0;
      font-size: 36px;
      font-weight: bold;
    }
    
    .estadistica-card p {
      margin: 10px 0 0 0;
      font-size: 14px;
      opacity: 0.9;
    }
    
    .info-tutor {
      background-color: #203e46ff;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      border-left: 5px solid #000000ff;
    }
    
    .info-tutor h3 {
      margin: 0 0 10px 0;
      color: #ffffffff;
    }
    
    .filtros-aplicados {
      background-color: #67e7d4ff;
      border: 1px solid #4ad65dff;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    
    .filtros-aplicados strong {
      color: #856404;
    }
    
    .botones-exportar {
      display: flex;
      gap: 10px;
      margin: 20px 0;
      flex-wrap: wrap;
    }
    
    .boton-exportar {
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    
    .boton-csv {
      background-color: #27ae60;
      color: white;
    }
    
    .boton-csv:hover {
      background-color: #229954;
    }
    
    .boton-pdf {
      background-color: #e74c3c;
      color: white;
    }
    
    .boton-pdf:hover {
      background-color: #c0392b;
    }
    
    .boton-volver {
      background-color: #95a5a6;
      color: white;
    }
    
    .boton-volver:hover {
      background-color: #7f8c8d;
    }
    
    .tabla-resultados {
      margin-top: 20px;
    }
    
    .sin-resultados {
      background-color: #0f241fff;
      border: 1px solid #000000ff;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
      margin: 20px 0;
    }
  </style>
</head>
<body>
<section class="seccion-estudiantes">
  <h2>📊 Resultado del Reporte por Tutor</h2>
  
  <div class="info-tutor">
    <h3>👨‍🏫 <?= htmlspecialchars($tutorInfo['nombre'] . ' ' . $tutorInfo['apellido']) ?></h3>
    <p><strong>Código:</strong> <?= htmlspecialchars($tutorInfo['codigo']) ?></p>
    <?php if (isset($tutorInfo['especialidad'])): ?>
      <p><strong>Especialidad:</strong> <?= htmlspecialchars($tutorInfo['especialidad']) ?></p>
    <?php endif; ?>
  </div>

  <?php if (isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin'])): ?>
  <div class="filtros-aplicados">
    <strong> Periodo:</strong> 
    <?= date('d/m/Y', strtotime($_GET['fecha_inicio'])) ?> - 
    <?= date('d/m/Y', strtotime($_GET['fecha_fin'])) ?>
    
    <?php if (isset($_GET['id_asignatura']) && $_GET['id_asignatura']): ?>
      <br><strong> Asignatura filtrada:</strong> Sí
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <div class="estadisticas-container">
    <div class="estadistica-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
      <h3><?= $estadisticas['total_sesiones'] ?></h3>
      <p> Total de Sesiones</p>
    </div>
    
    <div class="estadistica-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
      <h3><?= $estadisticas['total_estudiantes'] ?></h3>
      <p> Estudiantes Atendidos</p>
    </div>
    
    <div class="estadistica-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
      <h3><?= $estadisticas['total_asignaturas'] ?></h3>
      <p> Asignaturas Impartidas</p>
    </div>
  </div>

  <div class="botones-exportar">
    <a href="<?= BASE_URL ?>/reportes/exportar_csv?id_tutor=<?= $_GET['id_tutor'] ?>&fecha_inicio=<?= $_GET['fecha_inicio'] ?? '' ?>&fecha_fin=<?= $_GET['fecha_fin'] ?? '' ?>&id_asignatura=<?= $_GET['id_asignatura'] ?? '' ?>" 
       class="boton-exportar boton-csv">
       Exportar a CSV
    </a>
    
    <a href="<?= BASE_URL ?>/reportes/exportar_pdf?id_tutor=<?= $_GET['id_tutor'] ?>&fecha_inicio=<?= $_GET['fecha_inicio'] ?? '' ?>&fecha_fin=<?= $_GET['fecha_fin'] ?? '' ?>&id_asignatura=<?= $_GET['id_asignatura'] ?? '' ?>" 
       class="boton-exportar boton-pdf">
       Exportar a PDF
    </a>
    
    <a href="<?= BASE_URL ?>/reportes" 
       class="boton-exportar boton-volver">
      ← Volver a Filtros
    </a>
  </div>

  <div class="buscador">
    <input type="text" id="buscarSesion" placeholder="🔍 Buscar en resultados..." onkeyup="filtrarTabla()">
  </div>

  <?php if ($resultado && $resultado->num_rows > 0): ?>
  <div class="tabla-resultados">
    <table class="tabla-estudiantes">
      <thead>
        <tr>
          <th>ID</th>
          <th>Fecha y Hora</th>
          <th>Carnet</th>
          <th>Estudiante</th>
          <th>Código</th>
          <th>Asignatura</th>
          <th>Observaciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $resultado->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id_sesion'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['fecha_hora'])) ?></td>
            <td><?= htmlspecialchars($row['carnet']) ?></td>
            <td><?= htmlspecialchars($row['estudiante_nombre'] . ' ' . $row['estudiante_apellido']) ?></td>
            <td><?= htmlspecialchars($row['asignatura_codigo']) ?></td>
            <td><?= htmlspecialchars($row['asignatura_nombre']) ?></td>
            <td><?= htmlspecialchars($row['observaciones'] ?? '-') ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
  <div class="sin-resultados">
    <h3 style="color: #ffffffff;">🔍 No hay sesiones registradas</h3>
    <p>No hay sesiones registradas para este tutor con los filtros seleccionados.</p>
    <p>Intente modificar los criterios de búsqueda.</p>
  </div>
  <?php endif; ?>
</section>

<script>
function filtrarTabla() {
  const input = document.getElementById('buscarSesion');
  const filtro = input.value.toUpperCase();
  const tabla = document.querySelector('.tabla-estudiantes tbody');
  
  if (!tabla) return;
  
  const filas = tabla.getElementsByTagName('tr');
  
  for (let i = 0; i < filas.length; i++) {
    const celdas = filas[i].getElementsByTagName('td');
    let encontrado = false;
    
    for (let j = 0; j < celdas.length; j++) {
      const texto = celdas[j].textContent || celdas[j].innerText;
      if (texto.toUpperCase().indexOf(filtro) > -1) {
        encontrado = true;
        break;
      }
    }
    
    filas[i].style.display = encontrado ? '' : 'none';
  }
}
</script>
</body>
</html>