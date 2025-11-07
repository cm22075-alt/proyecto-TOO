<?php

require_once __DIR__ . '/../Config/db.php'; 

class Usuario {
    
    // Hacemos que la conexión sea una propiedad estática accesible globalmente
    // No necesitamos definirla aquí, la obtendremos del ámbito global.

    public function __construct() {
        // La conexión ya está establecida en db.php, no necesitamos código aquí.
    }

    /**
     * Busca un usuario por su nombre de usuario.
     * @param string $login Identificador (username)
     * @return array|null El registro del usuario o null si no se encuentra.
     */
    public function buscarPorLogin($login) {
        
        // Obtenemos la conexión establecida en Config/db.php
        global $conexion;
        
        // 1. Definimos la consulta a la tabla 'usuario' (la tabla real)
        $sql = "SELECT id_usuario, username, password_hash, rol 
                FROM usuario 
                WHERE username = ? 
                AND estado = 1  
                LIMIT 1";
        
        // 2. Usamos la sentencia preparada de mysqli para seguridad
        $stmt = $conexion->prepare($sql);

        // Verificamos si la preparación falló
        if (!$stmt) {
             error_log("MySQLi Prepare Error: " . $conexion->error);
             return null;
        }

        // 3. Enlazamos el parámetro: 's' para string
        $stmt->bind_param("s", $login);
        
        // 4. Ejecutamos la consulta
        $stmt->execute();
        
        // 5. Obtenemos el resultado
        $resultado = $stmt->get_result();
        
        // 6. Obtenemos la fila como un array asociativo
        $usuario = $resultado->fetch_assoc();
        
        // 7. Cerramos la sentencia
        $stmt->close();

        // Retornamos el usuario o null.
        // Mapeamos los nombres de columna al formato que espera Auth.php (si es necesario)
        if ($usuario) {
            // Renombramos 'username' a 'nombre' si Auth.php espera 'nombre' (como en la simulación)
            // Si Auth.php espera 'username', no hagas nada.
            $usuario['nombre'] = $usuario['username']; 
        }
        
        return $usuario ?: null;
    }
}