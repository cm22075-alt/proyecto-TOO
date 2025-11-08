<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>
<nav class="menu">
  <div class="nav-links">
    <a href="<?= BASE_URL ?>/dashboard">
      <img src="<?= BASE_URL ?>/assets/icono_minerva.png" alt="Inicio" class="icono-inicio">
    </a>

    <a href="<?= BASE_URL ?>/estudiantes">📋 Estudiantes</a>
    <a href="<?= BASE_URL ?>/asignaturas">📚 Asignaturas</a>
    <a href="<?= BASE_URL ?>/tutores">👨‍🏫 Tutores</a>
    <a href="<?= BASE_URL ?>/sesiones">🗓️ Sesiones</a>
    <a href="<?= BASE_URL ?>/reportes">📈 Reportes</a>
    <a href="<?= BASE_URL ?>/usuarios">👥 Usuarios</a>
    <a href="<?= BASE_URL ?>/auditoria">🕵️ Auditoría</a>
  </div>

  <form method="GET" action="<?= BASE_URL ?>/logout">
    <button class="logout">Cerrar sesión</button>
  </form>
</nav>
<div class="espacio-menu"></div>