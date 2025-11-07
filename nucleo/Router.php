<?php

class Router
{
    protected $rutas = [];

    /**
     * Agrega una ruta a la lista de rutas.
     * @param string $metodo HTTP (GET, POST, etc.)
     * @param string $uri URI a matchear (ej: '/login')
     * @param string $controladorAccion Controlador y método a ejecutar (ej: 'AccesoController@login')
     */
    public function add($metodo, $uri, $controladorAccion)
    {
        // Limpia la URI para asegurar que comience con '/'
        $uri = '/' . trim($uri, '/');

        // Almacena la ruta, el método y la acción
        $this->rutas[$metodo][$uri] = $controladorAccion;
    }

    // Métodos de conveniencia
    public function get($uri, $controladorAccion)
    {
        $this->add('GET', $uri, $controladorAccion);
    }

    public function post($uri, $controladorAccion)
    {
        $this->add('POST', $uri, $controladorAccion);
    }

    /**
     * Procesa la solicitud HTTP y dirige la ejecución al controlador.
     */
    public function dispatch()
    {
        require_once __DIR__ . '/../Config/db.php';

        // 1. Obtener la URI solicitada y normalizarla
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Quitar el prefijo BASE_URL de la URI si existe
        $base = rtrim(BASE_URL, '/');
        $uri = preg_replace('#^' . preg_quote($base, '#') . '#', '', $uri);
        $uri = '/' . trim($uri, '/');

        // 2. Obtener el método HTTP (GET, POST, etc.)
        $metodo = $_SERVER['REQUEST_METHOD'];

        // 3. Verificar si la ruta y el método existen
        if (!array_key_exists($metodo, $this->rutas) || !array_key_exists($uri, $this->rutas[$metodo])) {
            // Ruta no encontrada (ej: 404)
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
            return;
        }

        // 4. Obtener el controlador y la acción (ej: 'AccesoController@login')
        $controladorAccion = $this->rutas[$metodo][$uri];
        list($nombreControlador, $metodoAccion) = explode('@', $controladorAccion);

        // 5. Incluir el archivo del Controlador
        $archivoControlador = __DIR__ . '/../Controladores/' . $nombreControlador . '.php';

        // Usamos el check de file_exists antes de la inclusión
        if (!file_exists($archivoControlador)) {
            http_response_code(500);
            // Muestra el nombre del controlador para depuración
            echo "Error: Controlador $nombreControlador no encontrado.";
            return;
        }
        require_once $archivoControlador;

        // 6. Instanciar el Controlador y llamar al método
        try {
            // Aquí el error Class Not Found desaparecerá si la inclusión fue exitosa
            $controlador = new $nombreControlador();
            if (method_exists($controlador, $metodoAccion)) {
                $controlador->$metodoAccion();
            } else {
                http_response_code(500);
                echo "Error: Método $metodoAccion no existe en $nombreControlador.";
            }
        } catch (Throwable $e) {
            http_response_code(500);
            echo "Error interno del servidor: " . $e->getMessage();
        }
    }
}
