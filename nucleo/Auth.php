<?php
require_once __DIR__ . '/../Modelos/Usuario.php';

class Auth
{
    /**
     * Inicia la sesión si aún no está activa.
     */
    public static function iniciarSesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Verifica las credenciales de login.
     */
    public function verificarCredenciales($login, $password)
    {
        self::iniciarSesion();
        $usuarioModelo = new Usuario();

        // 1. Buscar usuario en la base de datos
        $usuario = $usuarioModelo->buscarPorLogin($login);

        if (!$usuario) {
            return false; // Usuario no encontrado
        }

        // 2. Verificar la contraseña
        if (password_verify($password, $usuario['password_hash'])) {
            // 3. Guardar los datos del usuario en la sesión
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nombre'] = $usuario['username'];
            $_SESSION['usuario_rol'] = $usuario['rol'];

            return true;
        }

        // 4. Si la contraseña no coincide
        return false;
    }

    /**
     * Verifica si el usuario está autenticado.
     */
    public static function estaAutenticado()
    {
        self::iniciarSesion();
        return isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true;
    }
}
