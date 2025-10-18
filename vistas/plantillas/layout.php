<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>
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
    <?php include_once($vista); ?>
  </main>
  
</body>
</html>
<?php include_once(dirname(__DIR__) . '/plantillas/footer.php'); ?>