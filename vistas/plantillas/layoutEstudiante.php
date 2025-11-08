<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($titulo ?? 'Panel del Estudiante') ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; }

    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #ffffff;
      color: #1f2937;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    
    #overlay-carga {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #ffffff;
      z-index: 999999;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      font-weight: 600;
      color: #2c3e50;
      transition: opacity 0.8s ease, visibility 0.8s ease;
    }

    #overlay-carga.oculto {
      opacity: 0;
      visibility: hidden;
    }

   
    .menu-fijo {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      background-color: #ffffff;
      border-bottom: 1px solid #e5e7eb;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    
    main.contenido {
      flex: 1;
      position: relative;
      margin-top: -50px;
      padding-top: 130px;
      padding-left: 36px;
      padding-right: 36px;
      padding-bottom: 60px;
      background-color: #ffffff;
      width: 100%;
      z-index: 1;
    }

    .contenido-inner {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }

    h2.page-title {
      font-size: 24px;
      font-weight: 700;
      color: #0b3b4a;
      margin: 6px 0 18px;
      text-align: left;
    }

    
    .info-registros {
      background-color: #1abc9c;
      color: #ffffff;
      margin-bottom: 20px;
      font-weight: 600;
      text-align: center;
      padding: 10px 0;
      border-radius: 8px;
      font-size: 15px;
    }

    
    .buscador {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .buscador input {
      padding: 9px 12px;
      width: 50%;
      border-radius: 8px;
      border: 1px solid #cbd5e1;
      font-size: 14px;
      color: #111827;
      background: #ffffff;
      text-align: center;
    }

    .buscador input:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(26,188,156,0.15);
      border-color: #1abc9c;
    }

    
    table.tabla-estudiantes {
      width: 100%;
      border-collapse: collapse;
      font-size: 15px;
      color: #111827;
      margin-top: 8px;
      background-color: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    }

    
    table.tabla-estudiantes thead th {
      background: #2c3e50;
      color: #fff;
      padding: 12px 10px;
      text-align: left;
    }

    table.tabla-estudiantes td {
      padding: 12px 10px;
      border-bottom: 1px solid #e5e7eb;
      color: #111827;
    }

    table.tabla-estudiantes tr:hover td {
      background: #f8fafc;
    }

    .badge-activo {
      display:inline-block;
      background: #10b981;
      color: #fff;
      padding: 6px 10px;
      border-radius: 6px;
      font-weight: 600;
      font-size: 13px;
    }

    .badge-inactivo {
      display:inline-block;
      background: #ef4444;
      color: #fff;
      padding: 6px 10px;
      border-radius: 6px;
      font-weight: 600;
      font-size: 13px;
    }

    
    footer.dashboard-footer {
      background-color: #2c3e50;
      color: #ffffff;
      text-align: center;
      padding: 10px 0;
      font-size: 14px;
      font-weight: 500;
      letter-spacing: 0.3px;
      box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
      margin-top: auto;
    }

    @media (max-width: 768px) {
      .buscador input { width: 100%; }
      main.contenido { padding: 120px 16px 60px; margin-top: -30px; }
    }
  </style>
</head>
<body>
  
  <div id="overlay-carga">Cargando...</div>

  
  <div class="menu-fijo">
    <?php include_once(dirname(__DIR__) . '/plantillas/menuEstudiante.php'); ?>
  </div>

  
  <main class="contenido">
    <div class="contenido-inner">
      <?php 
        if (isset($vista) && !empty($vista)) {
            $ruta_completa_vista = realpath(__DIR__ . '/../' . $vista);
            if ($ruta_completa_vista && file_exists($ruta_completa_vista)) {
                include_once($ruta_completa_vista);
            } else {
                echo "<p style='color:red; font-weight:bold;'>⚠️ Error: No se encontró la vista en:<br><code>$ruta_completa_vista</code></p>";
            }
        }
      ?>
    </div>
  </main>

  
  <footer class="dashboard-footer">
    © 2025 Sistema Administrativo | Desarrollado por Alumnos de Cátedra TOO115
  </footer>

  
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const overlay = document.getElementById('overlay-carga');
      setTimeout(() => {
        overlay.classList.add('oculto');
        setTimeout(() => overlay.remove(), 1000);
      }, 1500);
    });
  </script>
</body>
</html>
