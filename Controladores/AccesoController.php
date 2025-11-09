<?php
require_once __DIR__ . '/../nucleo/Auth.php';
require_once __DIR__ . '/../Config/db.php';

class AccesoController
{
    /**
     * Muestra el formulario de login o procesa la solicitud POST.
     */
    public function login()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
                $login = trim($_POST['usuario']);
                $password = $_POST['password'];

                $auth = new Auth();

                if ($auth->verificarCredenciales($login, $password)) {
                    $rol = $_SESSION['usuario_rol'] ?? '';

                    // Redirección personalizada según el rol
                    switch ($rol) {
                        case 'Admin':
                            header('Location: ' . BASE_URL . '/admin');
                            break;

                        case 'Tutor':
                            // Enviar al dashboard general
                            header('Location: ' . BASE_URL . '/dashboard');
                            break;

                        case 'Coord':
                            header('Location: ' . BASE_URL . '/coordinador');
                            break;

                        case 'Estud':
                            // Enviar al menú del estudiante
                            header('Location: ' . BASE_URL . '/vistas/plantillas/menuEstudiante.php');
                            break;

                        default:
                            // Si el rol no coincide con ninguno
                            header('Location: ' . BASE_URL . '/dashboard');
                            break;
                    }
                    exit;
                } else {
                    $error = "❌ Usuario o contraseña incorrectos.";
                }
            } else {
                $error = "⚠️ Por favor, completa ambos campos.";
            }
        }

        // Mostrar la vista del login
        require 'vistas/acceso/login.php';
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout()
    {
        Auth::iniciarSesion();

        $_SESSION = [];

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

        session_destroy();

        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
