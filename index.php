<?php
$modulo = $_GET['modulo'] ?? 'estudiantes';
$accion = $_GET['accion'] ?? 'listar';

// Mapeo de nombres de controlador
$archivo = "controladores/" . ucfirst($modulo) . "Controller.php";

if (file_exists($archivo)) {
  include_once($archivo);
} else {
  echo "<p style='color:red;'>Módulo no encontrado.</p>";
  echo "<pre>MODULO: $modulo\nACCION: $accion\nARCHIVO: $archivo</pre>";
}

