<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sesiones Registradas</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: Arial, sans-serif;
      overflow-x: hidden;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in {
      opacity: 0;
      animation: fadeInDown 0.8s ease-out forwards;
    }

    .tabla-sesion {
      width: 90%;
      margin: 30px auto;
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

    .acciones-superior {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .boton-agregar {
      display: inline-block;
      padding: 10px 18px;
      background-color: #003366;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      transition: all 0.3s ease;
      box-shadow: 0 3px 6px rgba(0,0,0,0.15);
    }

    .boton-agregar:hover {
      background-color: #0056b3;
      transform: scale(1.05);
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

    .boton-editar,
    .boton-eliminar {
      text-decoration: none;
      font-size: 1.2em;
      margin: 0 6px;
      transition: transform 0.2s ease;
      cursor: pointer;
    }

    .boton-editar:hover {
      transform: scale(1.2);
      color: #0d6efd;
    }

    .boton-eliminar:hover {
      transform: scale(1.2);
      color: #dc3545;
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

    .modal-confirmar {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.4);
      justify-content: center;
      align-items: center;
    }

    .modal-contenido {
      background-color: white;
      padding: 20px 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      text-align: center;
      width: 350px;
      animation: aparecer 0.3s ease;
    }

    @keyframes aparecer {
      from { transform: scale(0.9); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    .modal-contenido h3 {
      margin-top: 0;
      color: #003366;
    }

    .modal-botones {
      margin-top: 20px;
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .btn-confirmar {
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-si {
      background-color: #dc3545;
      color: white;
    }

    .btn-si:hover {
      background-color: #bb2d3b;
    }

    .btn-no {
      background-color: #6c757d;
      color: white;
    }

    .btn-no:hover {
      background-color: #5a6268;
    }
  </style>
</head>

<body>
<section class="tabla-sesion fade-in">
  <h2>📋 Sesiones Registradas</h2>

  <div class="acciones-superior">
    <a href="<?= BASE_URL ?>/sesiones/crear" class="boton-agregar">➕ Nueva sesión</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Estudiante</th>
        <th>Tutor</th>
        <th>Asignatura</th>
        <th>Fecha y hora</th>
        <th>Observaciones</th>
        <th>Videollamada</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if ($sesiones && $sesiones->num_rows > 0): 
        $i = 1;
        while ($s = $sesiones->fetch_assoc()): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($s['estudiante']) ?></td>
            <td><?= htmlspecialchars($s['tutor']) ?></td>
            <td><?= htmlspecialchars($s['asignatura']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($s['fecha_hora'])) ?></td>
            <td><?= htmlspecialchars($s['observaciones']) ?></td>
            <td>
              <a href="https://meet.google.com/sesion<?= $s['id_sesion'] ?>" target="_blank" class="boton-link">🎥 Unirse</a>
            </td>
            <td>
              <a href="<?= BASE_URL ?>/sesiones/editar?id=<?= $s['id_sesion'] ?>" class="boton-editar" title="Editar sesión">✏️</a>
              <a href="#" 
                 class="boton-eliminar" 
                 title="Eliminar sesión"
                 onclick="mostrarModal('<?= BASE_URL ?>/sesiones/eliminar?id=<?= $s['id_sesion'] ?>')">🗑️</a>
            </td>
          </tr>
        <?php endwhile;
      else: ?>
        <tr>
          <td colspan="8" class="no-sesiones">
            ⚠️ No hay sesiones registradas.
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>

<div class="modal-confirmar" id="modalConfirmar">
  <div class="modal-contenido">
    <h3>⚠️ Confirmar eliminación</h3>
    <p>¿Deseas eliminar esta sesión?</p>
    <div class="modal-botones">
      <button class="btn-confirmar btn-si" id="btnSi">Sí, eliminar</button>
      <button class="btn-confirmar btn-no" id="btnNo">Cancelar</button>
    </div>
  </div>
</div>

<script>
  let eliminarUrl = '';

  function mostrarModal(url) {
    eliminarUrl = url;
    document.getElementById('modalConfirmar').style.display = 'flex';
  }

  document.getElementById('btnSi').addEventListener('click', () => {
    window.location.href = eliminarUrl;
  });

  document.getElementById('btnNo').addEventListener('click', () => {
    document.getElementById('modalConfirmar').style.display = 'none';
  });
</script>
</body>
</html>
