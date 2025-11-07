
<?php include_once(dirname(__DIR__, 2) . '/config/db.php'); ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema TOO</title>
    
    <style>
        /* -------------------- ESTILOS GLOBALES PARA EL FONDO -------------------- */
        body {
            /* Usar la imagen de fondo de tus assets (ajustar la ruta si es necesario) */
            background-image: url('<?= BASE_URL ?>/assets/fondo.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            display: flex; 
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* -------------------- ESTILOS DEL CONTENEDOR DE LOGIN -------------------- */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.95); /* Fondo blanco semi-transparente */
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px; /* Ancho máximo para el formulario */
            text-align: center;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        .login-box h2 {
            color: #333;
            margin-bottom: 25px;
            font-size: 1.8em;
        }

        /* -------------------- ESTILOS DE FORMULARIO -------------------- */
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
            font-size: 0.9em;
        }

        .input-group input[type="text"],
        .input-group input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; 
            font-size: 1em;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #007bff; 
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <img src="<?= BASE_URL ?>/assets/icono_minerva.png" alt="Minerva Logo" class="login-logo">
        
        <h2>Iniciar Sesión</h2>
        
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/login" method="POST">
            
            <div class="input-group">
                <label for="usuario">Usuario o Email</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario o email" required>
            </div>
            
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
            </div>
            
            <button type="submit" class="login-button">Acceder al Sistema</button>
        </form>
    </div>
</div>

</body>
</html>