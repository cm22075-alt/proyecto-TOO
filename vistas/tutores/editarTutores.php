<?php include_once(dirname(__DIR__) . '/plantillas/menu.php'); ?>
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head><!--Código temporal en lo que se coloca el de la historia de usuario 2-->
  <meta charset="UTF-8">
  <title>Editar Tutor</title>
  <link rel="stylesheet" href="../../publico/recursos/estilo.css">
  <style>
    .formulario-container {
      max-width: 600px;
      margin: 30px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .grupo-formulario {
      margin-bottom: 20px;
    }
    
    .grupo-formulario label {
      display: block;
      font-weight: bold;
      margin-bottom: 8px;
      color: #2c3e50;
    }
    
    .grupo-formulario input,
    .grupo-formulario select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 14px;
      box-sizing: border-box;
    }
    
    .grupo-formulario input:focus {
      outline: none;
      border-color: #3498db;
    }
    
    .alerta-error {
      background-color: #e74c3c;
      color: white;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    
    .botones-formulario {
      display: flex;
      gap: 10px;
      margin-top: 25px;
    }
    
    .boton-actualizar {
      background-color: #3498db;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    
    .boton-actualizar:hover {
      background-color: #2980b9;
    }
    
    .boton-cancelar {
      background-color: #95a5a6;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
      display: inline-block;
    }
    
    .boton-cancelar:hover {
      background-color: #7f8c8d;
    }
    
    .info-id {
      background-color: #ecf0f1;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
      color: #7f8c8d;
    }
  </style>
</head>
<body>
<section class="seccion-estudiantes">
  <h2>✏️ Editar Tutor</h2>

  <?php if (isset($error)): ?>
    <div class="alerta-error">
      ⚠️ <?= htmlspecialchars($error) ?>
    </div>
  <?php endif; ?>

  <div class="formulario-container">
    <div class="info-id">
      <strong>ID del Tutor:</strong> <?= $tutor['id_tutor'] ?>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/index.php?modulo=tutores&accion=editar&id=<?= $tutor['id_tutor'] ?>">
      
      <div class="grupo-formulario">
        <label for="codigo"> Código del Tutor: *</label>
        <input type="text" name="codigo" id="codigo" required 
               placeholder="Ej: TUT001" maxlength="20"
               value="<?= htmlspecialchars($tutor['codigo']) ?>">
      </div>

      <div class="grupo-formulario">
        <label for="nombre"> Nombre: *</label>
        <input type="text" name="nombre" id="nombre" required 
               placeholder="Ej: Juan" maxlength="80"
               value="<?= htmlspecialchars($tutor['nombre']) ?>">
      </div>

      <div class="grupo-formulario">
        <label for="apellido"> Apellido: *</label>
        <input type="text" name="apellido" id="apellido" required 
               placeholder="Ej: Pérez" maxlength="80"
               value="<?= htmlspecialchars($tutor['apellido']) ?>">
      </div>

      <div class="grupo-formulario">
        <label for="email"> Email: *</label>
        <input type="email" name="email" id="email" required 
               placeholder="Ej: juan.perez@ejemplo.com" maxlength="120"
               value="<?= htmlspecialchars($tutor['email']) ?>">
      </div>

      <div class="grupo-formulario">
        <label for="especialidad"> Especialidad:</label>
        <input type="text" name="especialidad" id="especialidad" 
               placeholder="Ej: Matemáticas, Física, Programación..." maxlength="100"
               value="<?= htmlspecialchars($tutor['especialidad'] ?? '') ?>">
      </div>

      <div class="botones-formulario">
        <button type="submit" class="boton-actualizar">💾 Actualizar</button>
        <a href="<?= BASE_URL ?>/index.php?modulo=tutores&accion=listar" class="boton-cancelar">❌ Cancelar</a>
      </div>
    </form>
  </div>
</section>
</body>
</html>
