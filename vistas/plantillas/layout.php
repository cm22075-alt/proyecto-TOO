
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $titulo ?? 'Panel' ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/publico/recursos/estilo.css">
</head>
<body>
  <?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
  <main class="contenido">
    <div class="main-content">
    <?php 
    // Asegúrate de que $vista contenga la ruta relativa a la carpeta 'vistas/'
    
    if (isset($vista) && $vista) { 
        // __DIR__ es "vistas/plantillas"
        // /../ sube a "vistas/"
        // Luego concatena la ruta de la vista (ej: 'estudiantes/listarEstudiantes.php')

        // CORRECCIÓN CRÍTICA: Usar __DIR__ y mover hacia arriba
        $ruta_completa_vista = __DIR__ . '/../' . $vista; 
        
        if (file_exists($ruta_completa_vista)) {
            include_once($ruta_completa_vista);
        } else {
            // Error si la vista no existe
            echo "Error: La vista $vista no fue encontrada.";
        }
    }
    ?>
</div>
  </main>
  <?php include_once(dirname(__DIR__) . '/plantillas/footer.php'); ?>
</body>
</html>
