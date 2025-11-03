<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Estudiante</title>

  <style>
    /* Fondo y base */
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('<?= BASE_URL ?>/assets/fondo.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      color: white;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    /* Menú superior */
    nav.menu {
      background-color: rgba(44, 62, 80, 0.9);
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 1000;
      box-sizing: border-box;
    }

    /* Contenedor de enlaces */
    .nav-links {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 15px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
      font-size: 16px;
      white-space: nowrap;
    }

    .nav-links a:hover {
      color: #1abc9c;
    }

    /* Icono de inicio */
    .icono-inicio {
      width: 40px;
      height: 40px;
      vertical-align: middle;
      margin-right: 10px;
      transition: transform 0.3s;
    }

    .icono-inicio:hover {
      transform: scale(1.1);
    }

    /* Botón cerrar sesión */
    form {
      margin: 0;
    }

    .logout {
      background-color: #e74c3c;
      border: none;
      color: white;
      padding: 8px 18px;
      cursor: pointer;
      border-radius: 5px;
      font-weight: bold;
      transition: background 0.3s;
      font-size: 15px;
      white-space: nowrap;
    }

    .logout:hover {
      background-color: #c0392b;
    }

    /* Contenido principal */
    .contenido {
      margin-top: 120px;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
      padding: 0 20px;
    }

    .contenido h1 {
      font-size: 42px;
      text-shadow: 2px 2px 5px #000;
      margin-bottom: 10px;
    }

    .contenido p {
      font-size: 20px;
      color: #ecf0f1;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      nav.menu {
        flex-direction: column;
        align-items: flex-start;
      }
      .nav-links {
        width: 100%;
        justify-content: flex-start;
        flex-wrap: wrap;
        margin-bottom: 10px;
      }
      .logout {
        align-self: flex-end;
      }
    }
  </style>
</head>

<body>

  <nav class="menu">
    <div class="nav-links">
      <a href="<?= BASE_URL ?>/index.php">
        <img src="<?= BASE_URL ?>/assets/icono_minerva.png" alt="Inicio" class="icono-inicio">
      </a>
      <!-- Solo este enlace fue cambiado -->
      <a href="<?= BASE_URL ?>/index.php?modulo=asignaturasEstudiante&accion=listar">📚 Asignaturas</a>
      <a href="<?= BASE_URL ?>/index.php?modulo=tutores&accion=listar">👨‍🏫 Tutores</a>
      <a href="<?= BASE_URL ?>/index.php?modulo=sesiones&accion=listar">🗓️ Sesiones</a>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/logout.php">
      <button class="logout">Cerrar sesión</button>
    </form>
  </nav>

  <div class="contenido">
    <h1>Bienvenido, Estudiante 👋</h1>
    <p>Selecciona una opción del menú superior para comenzar.</p>
  </div>

</body>
</html>
