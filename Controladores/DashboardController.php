<?php

class DashboardController {
    
    // Este es el método 'index' que tu router está intentando llamar.
    public function index() {
        // Asegúrate de que el usuario esté autenticado antes de mostrar el dashboard
        if (!Auth::estaAutenticado()) {
            // Si el check de Auth en index.php falló, redirige de nuevo.
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Aquí iría la lógica para obtener datos del dashboard (si los hay)
        
        // Cargar la vista principal del dashboard
        require 'vistas/dashboard.php';
    }
}