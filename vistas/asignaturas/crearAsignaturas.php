<div class="formulario-asignatura">
    <h2>Crear Nueva Asignatura</h2>
    <form method="POST" action="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=crear">
        <label for="codigo">Código</label>
        <input type="text" id="codigo" name="codigo" required placeholder="Ej: MAT101">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required placeholder="Ej: Matemática I">

        <div class="botones-formulario-asignatura">
            <button type="submit" class="boton-guardar-asignatura">Guardar</button>
            <a href="<?= BASE_URL ?>/index.php?modulo=asignaturas&accion=listar" class="boton-volver-asignatura">Volver</a>
        </div>
    </form>
</div>
