<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php');?>

<!DOCTYPE html>
    <html lang="es">
 <head>
    <meta charset="UTF-8">
    <title>Auditoría del Sistema</title>
    <link rel="stylesheet" href="../../publico/recursos/estilo.css">
 </head>
    <body>
        <h2 class= "titulo-auditoria" style="color:rgb(16, 12, 76);">🕵️ Auditoría del Sistema</h2>
        <table class="tabla-auditoria">
        <thead>
            <tr>
            <th>Fecha</th>
            <th>Módulo</th>
            <th>Acción</th>
            <th>Descripción</th>
            <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $registros->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['fecha'] ?></td>
                <td><?= ucfirst($row['modulo']) ?></td>
                <td><?= ucfirst($row['accion']) ?></td>
                <td><?= $row['descripcion'] ?></td>
                <td><?= $row['usuario'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        </table>
    </body>
</html>