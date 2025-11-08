<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $titulo ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
  <style>
    .formulario-reporte {
      max-width: 800px;
      margin: 30px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .grupo-formulario {
      margin-bottom: 20px;
    }
    
    .grupo-formulario label {
      display: block;
      font-weight: bold;
      margin-bottom: 8px;
      color: #2c3e50;
    }
    
    .grupo-formulario input,
    .grupo-formulario select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 14px;
      box-sizing: border-box;
    }
    
    .grupo-formulario small {
      display: block;
      color: #7f8c8d;
      margin-top: 5px;
      font-size: 12px;
    }
    
    .grupo-fechas {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    
    .botones-accion {
      display: flex;
      gap: 10px;
      margin-top: 30px;
      justify-content: flex-start;
    }
    
    .boton-generar {
      background-color: #3498db;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s;
    }
    
    .boton-generar:hover {
      background-color: #2980b9;
    }
    
    .boton-limpiar {
      background-color: #95a5a6;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
    }
    
    .boton-limpiar:hover {
      background-color: #7f8c8d;
    }
    
    .alerta-error {
      background-color: #e74c3c;
      color: white;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    
    .info-ayuda {
      background-color: #ecf0f1;
      padding: 15px;
      border-left: 4px solid #3498db;
      margin-bottom: 20px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
<section class="seccion-estudiantes">
  <h2>📊 Reporte de Sesiones por Tutor</h2>
  
  <div class="info-ayuda">
    <strong>ℹ Información:</strong> Genera reportes detallados de las sesiones impartidas por un tutor específico. 
    Puedes filtrar por rango de fechas y asignatura para obtener información más específica.
  </div>

  <?php if (isset($error)): ?>
    <div class="alerta-error">
      ⚠ <?= htmlspecialchars($error) ?>
    </div>
  <?php endif; ?>

  <div class="formulario-reporte">
    <form method="GET" action="<?= BASE_URL ?>/reportes/generar">
      
      <div class="grupo-formulario">
        <label for="id_tutor">🎓 Tutor: *</label>
        <select name="id_tutor" id="id_tutor" required>
          <option value="">-- Seleccione un tutor --</option>
          <?php 
          // Manejar tanto arrays como mysqli_result
          if (is_array($tutores)) {
            foreach ($tutores as $tutor) {
              $selected = (isset($_GET['id_tutor']) && $_GET['id_tutor'] == $tutor['id_tutor']) ? 'selected' : '';
              echo "<option value='{$tutor['id_tutor']}' $selected>";
              echo htmlspecialchars($tutor['codigo'] . ' - ' . $tutor['nombre'] . ' ' . $tutor['apellido']);
              if (!empty($tutor['especialidad'])) {
                echo " (" . htmlspecialchars($tutor['especialidad']) . ")";
              }
              echo "</option>";
            }
          } else {
            // mysqli_result
            while ($tutor = $tutores->fetch_assoc()) {
              $selected = (isset($_GET['id_tutor']) && $_GET['id_tutor'] == $tutor['id_tutor']) ? 'selected' : '';
              echo "<option value='{$tutor['id_tutor']}' $selected>";
              echo htmlspecialchars($tutor['codigo'] . ' - ' . $tutor['nombre'] . ' ' . $tutor['apellido']);
              if (!empty($tutor['especialidad'])) {
                echo " (" . htmlspecialchars($tutor['especialidad']) . ")";
              }
              echo "</option>";
            }
          }
          ?>
        </select>
        <small>Campo obligatorio</small>
      </div>

      <div class="grupo-fechas">
        <div class="grupo-formulario">
          <label for="fecha_inicio"> Fecha Inicio:</label>
          <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?= $_GET['fecha_inicio'] ?? '' ?>">
          <small>Opcional - Desde qué fecha</small>
        </div>

        <div class="grupo-formulario">
          <label for="fecha_fin"> Fecha Fin:</label>
          <input type="date" name="fecha_fin" id="fecha_fin" value="<?= $_GET['fecha_fin'] ?? '' ?>">
          <small>Opcional - Hasta qué fecha</small>
        </div>
      </div>

      <div class="grupo-formulario">
        <label for="id_asignatura"> Asignatura:</label>
        <select name="id_asignatura" id="id_asignatura">
          <option value="">-- Todas las asignaturas --</option>
          <?php 
          // Manejar tanto arrays como mysqli_result
          if (is_array($asignaturas)) {
            foreach ($asignaturas as $asignatura) {
              $selected = (isset($_GET['id_asignatura']) && $_GET['id_asignatura'] == $asignatura['id_asignatura']) ? 'selected' : '';
              echo "<option value='{$asignatura['id_asignatura']}' $selected>";
              echo htmlspecialchars($asignatura['codigo'] . ' - ' . $asignatura['nombre']);
              echo "</option>";
            }
          } else {
            // mysqli_result  
            while ($asignatura = $asignaturas->fetch_assoc()) {
              $selected = (isset($_GET['id_asignatura']) && $_GET['id_asignatura'] == $asignatura['id_asignatura']) ? 'selected' : '';
              echo "<option value='{$asignatura['id_asignatura']}' $selected>";
              echo htmlspecialchars($asignatura['codigo'] . ' - ' . $asignatura['nombre']);
              echo "</option>";
            }
          }
          ?>
        </select>
        <small>Opcional - Filtrar por asignatura específica</small>
      </div>

      <div class="botones-accion">
        <button type="submit" class="boton-generar">🔍 Generar Reporte</button>
        <button type="button" class="boton-limpiar" onclick="limpiarFormulario()">🗑️ Limpiar Filtros</button>
      </div>
    </form>
  </div>
</section>

<script>
function limpiarFormulario() {
  window.location.href = '<?= BASE_URL ?>/reportes';
}

// Validaciones de fechas
document.querySelector('form').addEventListener('submit', function(e) {
  const fechaInicio = document.getElementById('fecha_inicio').value;
  const fechaFin = document.getElementById('fecha_fin').value;
  
  if ((fechaInicio && !fechaFin) || (!fechaInicio && fechaFin)) {
    e.preventDefault();
    alert('⚠ Si ingresa un rango de fechas, debe completar tanto la fecha de inicio como la fecha fin.');
    return false;
  }
  
  if (fechaInicio && fechaFin && fechaInicio > fechaFin) {
    e.preventDefault();
    alert('⚠ La fecha de inicio no puede ser mayor a la fecha fin.');
    return false;
  }
});

// Debug: mostrar en consola si se cargaron las asignaturas
console.log('Asignaturas cargadas:', document.querySelectorAll('#id_asignatura option').length - 1);
</script>
</body>
</html>