<?php include_once(dirname(__DIR__) . '/plantillas/menuEstudiante.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<section class="tabla-sesion fade-in">
  <h2>📋 Sesiones de Tutoría Disponibles</h2>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Tutor</th>
        <th>Asignatura</th>
        <th>Fecha y hora</th>
        <th>Observaciones</th>
        <th>Videollamada</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if ($sesiones && $sesiones->num_rows > 0): 
        $i = 1;
        while ($s = $sesiones->fetch_assoc()): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($s['tutor']) ?></td>
            <td><?= htmlspecialchars($s['asignatura']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($s['fecha_hora'])) ?></td>
            <td><?= htmlspecialchars($s['observaciones']) ?></td>
            <td>
              <a href="https://meet.google.com/sesion<?= $s['id_sesion'] ?>" 
                 target="_blank" 
                 class="boton-link">🎥 Unirse</a>
            </td>
          </tr>
        <?php endwhile;
      else: ?>
        <tr>
          <td colspan="6" class="no-sesiones">
            ⚠️ No hay sesiones disponibles en este momento.
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>

<style>
  body {
    background-color: #f4f6f9;
    font-family: Arial, sans-serif;
    overflow-x: hidden;
    margin: 0;
    padding: 0;
  }

  @keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .fade-in {
    opacity: 0;
    animation: fadeInDown 0.8s ease-out forwards;
  }

  .tabla-sesion {
    width: 90%;
    margin: 120px auto 30px auto; 
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  h2 {
    color: #003366;
    margin-bottom: 20px;
    text-align: center;
  }

  .tabla-sesion th {
    background-color: #003366;
    color: white;
    padding: 10px;
    border: 1px solid #ccc;
  }

  .tabla-sesion td {
    padding: 10px;
    color: #003366;
    border: 1px solid #ddd;
    background-color: #fff;
  }

  .tabla-sesion tr:nth-child(even) td {
    background-color: #f8f9fa;
  }

  .tabla-sesion tr:hover td {
    background-color: #eef3ff;
  }

  .boton-link {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 0.9em;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  .boton-link:hover {
    background-color: #0056b3;
    transform: scale(1.05);
  }

  .no-sesiones {
    background-color: #f8d7da;
    color: #721c24;
    text-align: center;
    font-weight: bold;
    padding: 12px;
    border-radius: 6px;
  }
</style>
