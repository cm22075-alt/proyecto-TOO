<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>

<nav style="background-color:#2c3e50; padding:10px;">
  <a href="<?= BASE_URL ?>/index.php" style="color:white; margin-right:20px; text-decoration:none;">🏠 Inicio</a>
  <a href="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=listar" style="color:white; margin-right:20px; text-decoration:none;">📋 Estudiantes</a>
  <a href="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=crear" style="color:white; margin-right:20px; text-decoration:none;">➕ Nuevo estudiante</a>
</nav>
