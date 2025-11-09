<?php
include_once(dirname(__DIR__) . '/plantillas/menu.php');

$rutaDB = dirname(__DIR__, 2) . '/config/db.php';
if (file_exists($rutaDB)) {
  include_once($rutaDB);
} else {
  die("<p style='color:red;font-weight:bold;'>❌ Error: no se encontró el archivo de conexión en $rutaDB</p>");
}

if (!isset($conexion) || !$conexion instanceof mysqli) {
  $host = 'localhost';
  $usuario = 'root';
  $contrasena = '1234';
  $base_datos = 'sigtafmo';
  $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
  if ($conexion->connect_error) {
    die("<p style='color:red;font-weight:bold;'>❌ Error al conectar a la base de datos: {$conexion->connect_error}</p>");
  }
  $conexion->set_charset("utf8mb4");
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("<p style='color:red;font-weight:bold;'>❌ ID de sesión no válido.</p>");
}

$id_sesion = intval($_GET['id']);

$sqlSesion = "SELECT * FROM sesion WHERE id_sesion = $id_sesion";
$res = $conexion->query($sqlSesion);
if (!$res || $res->num_rows === 0) {
  die("<p style='color:red;font-weight:bold;'>❌ Sesión no encontrada.</p>");
}
$sesion = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fecha_hora = $_POST['fecha_hora'] ?? '';
  $fecha_actual = date('Y-m-d H:i');

  if (strtotime($fecha_hora) < strtotime($fecha_actual)) {
    echo "<script>alert('❌ La fecha y hora no pueden ser anteriores a la actual.'); window.history.back();</script>";
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Sesión</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">

  <style>
    .formulario-estudiante {
      animation: fadeInDown 0.4s ease;
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      color: #0d47a1;
      text-align: center;
    }

    label {
      font-weight: bold;
      color: #0d47a1;
    }

    .botones-formulario {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .campo-link {
      background-color: #eef3ff;
      padding: 8px;
      border-radius: 6px;
      color: #003366;
      font-size: 0.95em;
      display: inline-block;
      margin-top: 4px;
    }

    .campo-link a {
      color: #0056b3;
      text-decoration: none;
      font-weight: bold;
    }

    .campo-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
<section class="formulario-estudiante">
  <h2>✏️ Editar Sesión</h2>

  <form method="POST" action="<?= BASE_URL ?>/sesiones/editar?id=<?= $sesion['id_sesion'] ?>">

    <!-- ESTUDIANTE -->
    <label>Estudiante:</label>
    <select name="id_estudiante" required>
      <?php
      $estudiantes = $conexion->query("SELECT id_estudiante, nombre, apellido FROM estudiante WHERE estado = 1 ORDER BY nombre ASC");
      if ($estudiantes && $estudiantes->num_rows > 0) {
        while ($e = $estudiantes->fetch_assoc()) {
          $selected = ($e['id_estudiante'] == $sesion['id_estudiante']) ? 'selected' : '';
          echo "<option value='{$e['id_estudiante']}' $selected>{$e['nombre']} {$e['apellido']}</option>";
        }
      } else {
        echo "<option disabled>No hay estudiantes registrados</option>";
      }
      ?>
    </select>

    <!-- ASIGNATURA -->
    <label>Asignatura:</label>
    <select name="id_asignatura" required>
      <?php
      $asignaturas = $conexion->query("SELECT id_asignatura, nombre FROM asignatura WHERE estado = 1 ORDER BY nombre ASC");
      if ($asignaturas && $asignaturas->num_rows > 0) {
        while ($a = $asignaturas->fetch_assoc()) {
          $selected = ($a['id_asignatura'] == $sesion['id_asignatura']) ? 'selected' : '';
          echo "<option value='{$a['id_asignatura']}' $selected>{$a['nombre']}</option>";
        }
      } else {
        echo "<option disabled>No hay asignaturas registradas</option>";
      }
      ?>
    </select>

    <!-- TUTOR -->
    <label>Tutor:</label>
    <select name="id_tutor" required>
      <?php
      $tutores = $conexion->query("SELECT id_tutor, nombre FROM tutor ORDER BY nombre ASC");
      if ($tutores && $tutores->num_rows > 0) {
        while ($t = $tutores->fetch_assoc()) {
          $selected = ($t['id_tutor'] == $sesion['id_tutor']) ? 'selected' : '';
          echo "<option value='{$t['id_tutor']}' $selected>{$t['nombre']}</option>";
        }
      } else {
        echo "<option disabled>No hay tutores registrados</option>";
      }
      ?>
    </select>

    <!-- FECHA Y HORA -->
    <label>Fecha y hora:</label>
    <input 
      type="datetime-local" 
      name="fecha_hora" 
      value="<?= date('Y-m-d\TH:i', strtotime($sesion['fecha_hora'])) ?>" 
      min="<?= date('Y-m-d\TH:i') ?>"
      required
    >

    <!-- OBSERVACIONES -->
    <label>Observaciones:</label>
    <textarea name="observaciones" rows="3"><?= htmlspecialchars($sesion['observaciones']) ?></textarea>

    <!-- ENLACE DE VIDEOLLAMADA -->
    <label>Enlace de videollamada:</label>
    <div class="campo-link">
      Enlace a la videollamada: 
      <a href="https://meet.google.com/sesion<?= rand(1000,9999) ?>" target="_blank">
        https://meet.google.com/sesion<?= rand(1000,9999) ?>
      </a>
    </div>

    <div class="botones-formulario">
      <button type="submit" class="boton-guardar">Guardar cambios</button>
      <a href="<?= BASE_URL ?>/sesiones" class="boton-volver">Cancelar</a>
    </div>

  </form>
</section>
</body>
</html>
