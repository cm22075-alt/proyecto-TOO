<?php
require_once 'Modelos/Usuario.php';

class Auth {
    // ... iniciarSesion() y estaAutenticado() están bien ...

    public static function iniciarSesion() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function verificarCredenciales($login, $password) {
        self::iniciarSesion();
        $usuarioModelo = new Usuario();
        
        // 1. Buscar el usuario en la base de datos (Obtiene id_usuario, username, password_hash, rol)
        $usuario = $usuarioModelo->buscarPorLogin($login);

        if (!$usuario) {
            return false; // Usuario no encontrado
        }

        // 2. Verificar la contraseña hasheada
        if (password_verify($password, $usuario['password_hash'])) {
            // 3. Credenciales válidas: Guardar datos en la sesión
            
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            
            // *** AJUSTE CRÍTICO ***: Usar 'username' y 'rol' de la DB
            $_SESSION['usuario_nombre'] = $usuario['username']; 
            $_SESSION['usuario_rol'] = $usuario['rol'];
            
            return true;
        }

        // 4. Contraseña incorrecta
        return false;
        try {
        echo "Error: Método $metodoAccion no existe en $nombreControlador.";
        } catch (Exception $e) {
            http_response_code(500);
            echo "Error al ejecutar la acción: " . $e->getMessage();
        }
    
}

    public static function estaAutenticado() {
        self::iniciarSesion();
        return isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true;
    }
}