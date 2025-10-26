<div class="formulario-asignatura">
    <h2>Editar Asignatura</h2>
    <form method="POST" action="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=editar&id=<?= $data['id_asignatura'] ?>">
        <label for="codigo">Código</label>
        <input type="text" id="codigo" name="codigo" value="<?= htmlspecialchars($data['codigo']) ?>" required placeholder="Ej: MAT101">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($data['nombre']) ?>" required placeholder="Ej: Matemática I">

        <label for="estado">Estado</label>
        <select id="estado" name="estado">
            <option value="1" <?= $data['estado'] ? 'selected' : '' ?>>Activo</option>
            <option value="0" <?= !$data['estado'] ? 'selected' : '' ?>>Inactivo</option>
        </select>

        <div class="botones-formulario-asignatura">
            <button type="submit" class="boton-guardar-asignatura">Guardar</button>
            <a href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=listar" class="boton-volver-asignatura">Volver</a>
        </div>
    </form>
</div>
