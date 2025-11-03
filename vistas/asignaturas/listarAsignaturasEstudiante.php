<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); 
if (!isset($asignaturas)) {
    echo "<p style='color:red;'>Error: la variable \$asignaturas no está definida.</p>";
    return;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignaturas Registradas</title>
    <link rel="stylesheet" href="../../publico/recursos/estilo.css">
    <style>
        body {
            background-color: #ffffff !important;
            background-image: none !important;
            color: #2c3e50;
            padding-top: 20px; /* reducir espacio ahora que no hay menú */
        }
        .seccion-estudiantes {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <section class="seccion-estudiantes">
        <h2>📘 Asignaturas Registradas</h2>

        <div class="info-registros">
            <p>📊 Total de asignaturas: <strong><?= $asignaturas->num_rows ?></strong></p>
        </div>

        <div class="buscador">
            <input type="text" id="buscarAsignatura" placeholder="🔍 Buscar por código o nombre..." onkeyup="filtrarTabla()">
        </div>

        <table class="tabla-estudiantes">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($asignaturas && $asignaturas->num_rows > 0): ?>
                    <?php while ($row = $asignaturas->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_asignatura'] ?></td>
                            <td><?= htmlspecialchars($row['codigo']) ?></td>
                            <td><?= htmlspecialchars($row['nombre']) ?></td>
                            <td>
                                <span class="badge badge-<?= $row['estado'] ? 'activo' : 'inactivo' ?>">
                                    <?= $row['estado'] ? '✓ Activo' : '✗ Inactivo' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No hay asignaturas registradas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <script>
        function filtrarTabla() {
            const input = document.getElementById('buscarAsignatura');
            const filtro = input.value.toUpperCase();
            const tabla = document.querySelector('.tabla-estudiantes tbody');
            const filas = tabla.getElementsByTagName('tr');

            for (let i = 0; i < filas.length; i++) {
                const codigo = filas[i].getElementsByTagName('td')[1];
                const nombre = filas[i].getElementsByTagName('td')[2];
                if (codigo && nombre) {
                    const textocodigo = codigo.textContent || codigo.innerText;
                    const textonombre = nombre.textContent || nombre.innerText;
                    filas[i].style.display =
                        textocodigo.toUpperCase().includes(filtro) ||
                        textonombre.toUpperCase().includes(filtro)
                        ? ''
                        : 'none';
                }
            }
        }
    </script>
</body>
</html>
