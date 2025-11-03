<?php
$modulo = $_GET['modulo'] ?? 'dashboard';
$accion = $_GET['accion'] ?? 'listar';

if ($modulo === 'dashboard') {
  include_once('vistas/dashboard.php');
  return;
}

$archivo = "Controladores/" . ucfirst($modulo) . "Controller.php";
echo "<pre>DEBUG: ARCHIVO=$archivo</pre>";

if (file_exists($archivo)) {
  include_once($archivo);
} else {
  echo "<p style='color:red;'>Módulo no encontrado.</p>";
  echo "<pre>MODULO: $modulo\nACCION: $accion\nARCHIVO: $archivo</pre>";
}