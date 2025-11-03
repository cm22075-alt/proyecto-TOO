<?php include_once(__DIR__ . '/../config/db.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Principal</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('<?= BASE_URL ?>/assets/fondo.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      color: white;
    }
    nav {
      background-color: rgba(44, 62, 80, 0.9);
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
    }
    .nav-links a {
      color: white;
      margin-right: 25px;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
    }
    .nav-links a:hover {
      color: #1abc9c;
    }
    .logout {
      background-color: #e74c3c;
      border: none;
      color: white;
      padding: 8px 15px;
      cursor: pointer;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .logout:hover {
      background-color: #c0392b;
    }
    .contenido {
      margin-top: 100px;
      text-align: center;
      animation: fadeIn 1.5s ease-in-out;
    }
    .contenido h1 {
      font-size: 48px;
      margin-bottom: 20px;
      text-shadow: 2px 2px 5px #000;
    }
    .contenido p {
      font-size: 20px;
      color: #ecf0f1;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <nav>
    <div class="nav-links">
      <a href="<?= BASE_URL ?>/index.php?modulo=estudiantes&accion=listar">📋 Estudiantes</a>
      <a href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=listar">📚 Asignaturas</a>
      <a href="<?= BASE_URL ?>/index.php?modulo=tutores&accion=listar">👨‍🏫 Tutores</a>
      <a href="<?= BASE_URL ?>/index.php?modulo=sesiones&accion=listar">🗓️ Sesiones</a>
      <a href="<?= BASE_URL ?>/index.php?modulo=reporteTutor&accion=listar">📈 Reportes</a>
      <a href="<?= BASE_URL ?>/index.php?modulo=usuarios&accion=listar">👥 Usuarios</a>
    </div>
    <form method="POST" action="<?= BASE_URL ?>/logout.php">
      <button class="logout">Cerrar sesión</button>
    </form>
  </nav>

  <div class="contenido">
    <h1>Bienvenido al Sistema Administrativo</h1>
    <p>Selecciona una opción del menú para comenzar</p>
  </div>
</body>
</html>
