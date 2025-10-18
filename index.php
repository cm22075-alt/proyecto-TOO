<?php
// Activar errores en desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Definir rutas base
define('CONTROLADORES', __DIR__ . '/controladores/');
define('VISTAS', __DIR__ . '/vistas/');
define('MODELOS', __DIR__ . '/modelos/');
define('CONFIG', __DIR__ . '/config/');

// Cargar conexión
include_once CONFIG.'db.php';

// Obtener ruta solicitada
$modulo = $_GET['modulo'] ?? 'estudiantes';
$accion = $_GET['accion'] ?? 'listar';

// Mapear controlador
$controladorArchivo = CONTROLADORES . ucfirst($modulo) . 'Controller.php';

if (file_exists($controladorArchivo)) {
    include_once $controladorArchivo;
} else {
    echo "<h2>Error 404: El módulo solicitado no existe.</h2>";
}
