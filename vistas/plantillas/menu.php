<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>
<nav class="menu">
  <div class="nav-links">
    <a href="<?= BASE_URL ?>/index.php">
      <img src="<?= BASE_URL ?>/assets/icono_minerva.png" alt="Inicio" class="icono-inicio">
    </a>
    <a href="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=listar">📋 Estudiantes</a>
    <a href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=listar">📚 Asignaturas</a>
    <a href="<?= BASE_URL ?>/index.php?modulo=tutores&accion=listar">👨‍🏫 Tutores</a>
    <a href="<?= BASE_URL ?>/index.php?modulo=sesiones&accion=listar">🗓️ Sesiones</a>
    <a href="<?= BASE_URL ?>/index.php?modulo=reportes&accion=listar">📈 Reportes</a>
    <a href="<?= BASE_URL ?>/index.php?modulo=usuarios&accion=listar">👥 Usuarios</a>
  </div>
  <form method="POST" action="<?= BASE_URL ?>/logout.php">
    <button class="logout">Cerrar sesión</button>
  </form>
</nav>
<div class="espacio-menu"></div>
