<?php
include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/AsignaturaEstudiante.php');

$asignaturaModelo = new AsignaturaEstudiante($conexion);
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'listar':
        $asignaturas = $asignaturaModelo->listar();
        $titulo = 'Asignaturas Registradas';
        $vista = dirname(__DIR__) . '/vistas/asignaturas/listarAsignaturasEstudiante.php';
        include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
        break;

    default:
        echo "Acción no reconocida.";
}
?>
