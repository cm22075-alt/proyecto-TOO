<?php
$extensiones = get_loaded_extensions();
echo "<h2>Extensiones cargadas:</h2><ul>";
foreach ($extensiones as $ext) {
  echo "<li>$ext</li>";
}
echo "</ul>";

echo 'Versión PHP: ' . phpversion();
echo '<br>Ruta PHP: ' . PHP_BINARY;
?>
