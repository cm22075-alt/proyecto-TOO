<?php
include_once(dirname(__DIR__) . '/config/db.php');
include_once(dirname(__DIR__) . '/modelos/Auditoria.php');



switch ($accion) {
    case 'listar':
      include_once(dirname(__DIR__) . '/modelos/Auditoria.php');
      $auditoriaModelo = new Auditoria($conexion);
      $accion = $_GET['accion'] ?? 'listar';
      $registros = $auditoriaModelo->listar();
      $titulo = 'Auditoría del sistema';
      $vista = dirname(__DIR__) . '/vistas/auditoria/listarAuditoria.php';
      include_once(dirname(__DIR__) . '/vistas/plantillas/layout.php');
      break;
  
    default:
      echo "<p style='color:red;'>Acción no permitida en el módulo de auditoría.</p>";
      break;
  }