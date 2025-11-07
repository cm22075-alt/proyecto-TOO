<?php
// Incluir la clase Auth para la lógica de autenticación
// Asegúrate de que la ruta sea correcta desde este archivo
require_once __DIR__ . '/../nucleo/Auth.php';
// Asegurar que BASE_URL esté disponible para las redirecciones
require_once __DIR__ . '/../Config/db.php';

class AccesoController
{

    // ... (Tu método login() implementado anteriormente) ...

    /**
     * Muestra el formulario de login o procesa la solicitud POST.
     */
    public function login()
    {
        $error = '';

        // CÓDIGO DE LOGIN AQUÍ...

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['usuario']) && isset($_POST['password'])) {
                $login = trim($_POST['usuario']);
                $password = $_POST['password'];

                $auth = new Auth();

                if ($auth->verificarCredenciales($login, $password)) {
                    header('Location: ' . BASE_URL . '/dashboard');
                    exit;
                } else {
                    $error = "Usuario o contraseña incorrectos. Inténtalo de nuevo.";
                }
            } else {
                $error = "Por favor, completa ambos campos.";
            }
        }

        // Cargar la vista de login, pasando la variable $error
        require 'vistas/acceso/login.php';
    }

    // --- NUEVO MÉTODO DE LOGOUT ---

    /**
     * Cierra la sesión del usuario.
     */
    public function logout()
    {
        // 1. Asegurarse de que la sesión esté iniciada para manipularla
        Auth::iniciarSesion();

        // 2. Limpiar el array $_SESSION
        $_SESSION = [];

        // 3. Destruir la cookie de sesión del lado del cliente/servidor (crucial)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // 4. Destruir la sesión en el almacenamiento de PHP
        session_destroy();

        // 5. Redirigir al login usando la BASE_URL
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
