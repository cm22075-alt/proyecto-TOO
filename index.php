<?php

// =================================================================
// 1. INICIALIZACIÓN Y CONFIGURACIÓN GLOBAL
// =================================================================

// 1.1 Cargar configuración (BASE_URL y conexión DB)
// El archivo db.php ahora solo debe contener la lógica de conexión (mysqli)
// y NO la definición de BASE_URL.
require_once 'Config/db.php'; 

// 1.2 Definición de la URL base para XAMPP
// ¡CRÍTICO! Definir la constante BASE_URL aquí y solo aquí.
if (!defined('BASE_URL')) {
    // Reemplaza '/proyecto-TOO' con el nombre exacto de tu carpeta en htdocs.
    define('BASE_URL', '/proyecto-TOO'); 
}

// 1.3 Cargar la lógica de autenticación y iniciar la sesión
require_once 'nucleo/Auth.php';
Auth::iniciarSesion(); 

// 1.4 Cargar el Router
require_once 'nucleo/Router.php';

$router = new Router();

// =================================================================
// 2. DEFINICIÓN DE RUTAS
// =================================================================

// --- RUTAS PÚBLICAS (ACCESIBLES SIN LOGIN) ---

// Mapear la raíz ('/') y '/login' al mismo método para mostrar el formulario
$router->get('/', 'AccesoController@login'); 
$router->get('/login', 'AccesoController@login'); 
$router->post('/login', 'AccesoController@login');

// --- RUTAS DE SALIDA ---

// El logout solo necesita un método GET (o POST, si el formulario usa POST)
$router->get('/logout', 'AccesoController@logout');

// ! --- RUTAS PROTEGIDAS (ACCESIBLES SOLO CON LOGIN) ---

// * Dashboard principal después del login
$router->get('/dashboard', 'DashboardController@index'); 

// * Rutas para estudiantes
$router->get('/estudiantes/crear', 'EstudiantesController@crear'); 
$router->post('/estudiantes/crear', 'EstudiantesController@crear'); //ruta para crear estudiantes

$router->get('/estudiantes/editar', 'EstudiantesController@editar'); //ruta para editar estudiantes
$router->post('/estudiantes/editar', 'EstudiantesController@editar'); //ruta para editar estudiantes

$router->get('/estudiantes/eliminar', 'EstudiantesController@eliminar'); //ruta para eliminar estudiantes

$router->get('/estudiantes', 'EstudiantesController@listar'); //ruta para listar estudiantes


//* Rutas para asignaturas
$router->get('/asignaturas', 'AsignaturasController@listar'); //ruta para listar asignaturas

$router->get('/asignaturas/crear', 'AsignaturasController@crear'); //ruta para crear asignaturas
$router->post('/asignaturas/crear', 'AsignaturasController@crear'); 

$router->get('/asignaturas/editar', 'AsignaturasController@editar'); //ruta para editar asignaturas
$router->post('/asignaturas/editar', 'AsignaturasController@editar');

$router->get('/asignaturas/eliminar', 'AsignaturasController@eliminar'); //ruta para eliminar asignaturas

$router->get('/asignaturas/cambiarEstado', 'AsignaturasController@cambiarEstado'); //ruta para cambiar estado de asignaturas


//* Rutas para tutores

$router->get('/tutores', 'TutoresController@listar'); //ruta para listar tutores

$router->get('/tutores/crear', 'TutoresController@crear'); //ruta para crear tutores
$router->post('/tutores/crear', 'TutoresController@crear');

$router->get('/tutores/reporte', 'ReporteTutorController@listar'); //ruta para reporte por tutores
$router->post('/tutores/reporte', 'ReporteTutorController@listar');

$router->get('/tutores/editar', 'TutoresController@editar'); //ruta para editar tutores
$router->post('/tutores/editar', 'TutoresController@editar');

$router->get('/tutores/eliminar', 'TutoresController@eliminar'); //ruta para eliminar tutores

$router->get('/tutores/cambiarEstado', 'TutoresController@cambiarEstado'); //ruta para cambiar estado de tutores

//*n Rutas para Sesiones

$router->get('/sesiones', 'SesionesController@listar'); //ruta para listar sesiones

$router->get('/sesiones/crear', 'SesionesController@crear'); //ruta para crear sesiones
$router->post('/sesiones/crear', 'SesionesController@crear');

$router->get('/sesiones/editar', 'SesionesController@editar'); //ruta para editar sesiones
$router->post('/sesiones/editar', 'SesionesController@editar');

$router->get('/sesiones/eliminar', 'SesionesController@eliminar'); //ruta para eliminar sesiones

$router->get('/sesiones/cambiarEstado', 'SesionesController@cambiarEstado'); //ruta para cambiar estado de sesiones

//* Rutas para Reportes

   $router->get('/reportes', 'ReporteTutorController@listar');
   $router->get('/reportes/generar', 'ReporteTutorController@generar');
   $router->get('/reportes/exportar_csv', 'ReporteTutorController@exportar_csv');
   $router->get('/reportes/exportar_pdf', 'ReporteTutorController@exportar_pdf');

$router->get('/reportes/crear', 'ReportesController@crear'); //ruta para crear reportes
$router->post('/reportes/crear', 'ReportesController@crear');

$router->get('/reportes/editar', 'ReportesController@editar'); //ruta para editar reportes
$router->post('/reportes/editar', 'ReportesController@editar'); 

$router->get('/reportes/eliminar', 'ReportesController@eliminar'); //ruta para eliminar reportes

$router->get('/reportes/cambiarEstado', 'ReportesController@cambiarEstado'); //ruta para cambiar estado de reportes

//* Rutas para usuarios

$router->get('/usuarios', 'UsuarioController@listar'); //ruta para listar usuarios

$router->get('/usuarios/crear', 'UsuarioController@crear'); //ruta para crear usuarios
$router->post('/usuarios/crear', 'UsuarioController@crear');   

$router->get('/usuarios/editar', 'UsuarioController@actualizar'); //ruta para editar usuarios
$router->post('/usuarios/editar', 'UsuarioController@actualizar');

$router->get('/usuarios/eliminar', 'UsuarioController@eliminar'); //ruta para eliminar usuarios    

$router->get('/usuarios/cambiarEstado', 'UsuarioController@cambiarEstado'); //ruta para cambiar estado de usuarios

//* Rutas para auditoria

$router->get('/auditoria', 'AuditoriaController@listar'); //ruta para listar auditoria

/*$router->get('/auditoria/crear', 'AuditoriaController@crear'); //ruta para crear auditoria
$router->post('/auditoria/crear', 'AuditoriaController@crear');

$router->get('/auditoria/editar', 'AuditoriaController@editar'); //ruta para editar auditoria
$router->post('/auditoria/editar', 'AuditoriaController@editar');

$router->get('/auditoria/eliminar', 'AuditoriaController@eliminar'); //ruta para eliminar auditoria

$router->get('/auditoria/cambiarEstado', 'AuditoriaController@cambiarEstado'); //ruta para cambiar estado de auditoria
*/



//~ =================================================================
//~ 3. LÓGICA DE SEGURIDAD (FRONT CONTROLLER)
//~ =================================================================

// 3.1 Obtener y limpiar la URI solicitada
$currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentUri = '/' . trim($currentUri, '/');

// 3.2 Normalizar la URI quitando la BASE_URL para obtener la ruta lógica
$base = rtrim(BASE_URL, '/');
$currentUriRelative = preg_replace('#^' . preg_quote($base, '#') . '#', '', $currentUri);
// Asegura que si la URL es '/proyecto-TOO/', la ruta relativa sea '/'
$currentUriRelative = $currentUriRelative === '' ? '/' : $currentUriRelative; 


// 3.3 DEFINICIÓN DE RUTAS PÚBLICAS GLOBALES
$rutasPublicas = ['/', '/login'];

// Si el usuario NO está autenticado Y la ruta NO es una ruta pública
if (!Auth::estaAutenticado() && !in_array($currentUriRelative, $rutasPublicas)) {
    
    // Redirigir al login si intenta acceder a /dashboard, /estudiantes, etc.
    header('Location: ' . BASE_URL . '/login');
    exit;
}

//~ =================================================================
//~ 4. DESPACHO DE LA SOLICITUD
//~ =================================================================

$router->dispatch();