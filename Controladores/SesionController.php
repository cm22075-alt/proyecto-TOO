<?php
include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/Sesion.php');
include_once(dirname(__DIR__) . '/modelos/Auditoria.php');

$sesionModelo = new Sesion($conexion);
$auditoria = new Auditoria($conexion);
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
  case 'listar':
    $sesiones = $sesionModelo->listar();
    $fechaInicio = $_POST['fecha_inicio'] ?? '';
    $fechaFin = $_POST['fecha_fin'] ?? '';
    $idTutor = $_POST['id_tutor'] ?? '';
    $idAsignatura = $_POST['id_asignatura'] ?? '';
    $reporte = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $fechaInicio && $fechaFin) {
      $reporte = $sesionModelo->reporteFiltrado($fechaInicio, $fechaFin, $idTutor, $idAsignatura);
    }

    $titulo = 'Sesiones registradas';
    $vista = dirname(__DIR__) . '/vistas/sesiones/listarSesiones.php';
    include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
    include_once($vista);
    break;

  case 'crear':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      session_start();
      $datos = $_POST;
      $estudiantes = $datos['estudiantes'];

      foreach ($estudiantes as $id_estudiante) {
        $sesionModelo->crear([
          'id_estudiante' => $id_estudiante,
          'id_tutor' => $datos['id_tutor'],
          'id_asignatura' => $datos['id_asignatura'],
          'fecha_hora' => $datos['fecha_hora'],
          'observaciones' => $datos['observaciones'],
          'creado_por' => $_SESSION['usuario_id']
        ]);

        $descripcion = "Se registró sesión para estudiante ID {$id_estudiante}";
        $auditoria->registrar('sesion', 'crear', $descripcion, $_SESSION['usuario_id']);
      }

      header("Location: " . BASE_URL . "/index.php?modulo=sesion&accion=listar");
      exit;
    } else {
      $titulo = 'Registrar sesión grupal';
      $vista = dirname(__DIR__) . '/vistas/sesiones/crearSesiones.php';
      include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
      include_once($vista);
    }
    break;

  case 'editar':
    $id = $_GET['id'] ?? null;
    if (!$id) {
      echo "ID no proporcionado.";
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $sesionModelo->actualizar($id, $_POST);
      $descripcion = "Se modificó la sesión ID {$id}";
      $auditoria->registrar('sesion', 'editar', $descripcion, $_SESSION['usuario_id']);
      header("Location: " . BASE_URL . "/index.php?modulo=sesion&accion=listar");
      exit;
    } else {
      $sesion = $sesionModelo->obtener($id);
      $titulo = 'Editar sesión';
      $vista = dirname(__DIR__) . '/vistas/sesiones/editarSesiones.php';
      include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
      include_once($vista);
    }
    break;

  case 'eliminar':
    $id = $_GET['id'] ?? null;
    if ($id) {
      $sesionModelo->eliminar($id);
      $descripcion = "Se eliminó la sesión ID {$id}";
      $auditoria->registrar('sesion', 'eliminar', $descripcion, $_SESSION['usuario_id']);
    }
    header("Location: " . BASE_URL . "/index.php?modulo=sesion&accion=listar");
    exit;

  default:
    echo "<p style='color:red;'>Acción no reconocida.</p>";
}
