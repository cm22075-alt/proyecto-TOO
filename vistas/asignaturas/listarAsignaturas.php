<div class="seccion-asignaturas">
    <h2>Listado de Asignaturas</h2>
    <div class="acciones-superiores-asignatura">
        <a href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=crear" class="boton-nuevo-asignatura">+ Nueva Asignatura</a>
    </div>

    <table class="tabla-asignaturas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($asignaturas as $asig): ?>
                <tr>
                    <td><?= $asig['id_asignatura'] ?></td>
                    <td><?= $asig['codigo'] ?></td>
                    <td><?= $asig['nombre'] ?></td>
                    <td>
                        <span style="color: <?= $asig['estado'] ? 'green' : 'red' ?>; font-weight:bold;">
                            <?= $asig['estado'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=editar&id=<?= $asig['id_asignatura'] ?>" class="accion-editar-asignatura">Editar</a>
                        
                        <form style="display:inline" method="POST" action="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=cambiarEstado">
                            <input type="hidden" name="id" value="<?= $asig['id_asignatura'] ?>">
                            <input type="hidden" name="estado" value="<?= $asig['estado'] ? 0 : 1 ?>">
                            <button type="submit" class="accion-eliminar-asignatura">
                                <?= $asig['estado'] ? 'Desactivar' : 'Activar' ?>
                            </button>
                        </form>

                        <form style="display:inline" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta asignatura?')" action="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=eliminar">
                            <input type="hidden" name="id" value="<?= $asig['id_asignatura'] ?>">
                            <button type="submit" class="accion-eliminar-asignatura">Eliminar</button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
