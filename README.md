/SIGTAFMO/
├── /config/                # Configuración global
│   └── db.php              # Conexión a la base de datos
│  
│
├── /core/                  # Núcleo del sistema
│   └── Router.php          # Enrutador básico
│   └── Auth.php            # Control de sesión y roles
│   └── Helpers.php         # Funciones auxiliares
│
├── /models/                # MODELO: lógica de datos
│   ├── Estudiante.php
│   ├── Tutor.php
│   ├── Asignatura.php
│   ├── Usuario.php
│   ├── Sesion.php
│   └── Auditoria.php
│
├── /controllers/           # CONTROLADOR: lógica de negocio
│   ├── EstudiantesController.php
│   ├── TutorController.php
│   ├── AsignaturaController.php
│   ├── UsuarioController.php
│   ├── SesionController.php
│   ├── ReporteController.php
│   └── AuthController.php
│
├── /vistas/                 # VISTA: interfaz de usuario
│   ├── /estudiantes/
│   │   ├── crear.php
│   │   ├── editar.php
│   │   └── listar.php
│   ├── /tutores/
│   ├── /asignaturas/
│   ├── /sesiones/
│   ├── /reportes/
│   ├── /usuarios/
│   ├── /auth/
│   │   └── login.php
│   ├── /plantillas/
│   │   ├── header.php
│   │   ├── footer.php
│   │   └── menu.php
│   └── dashboard.php
│
├── /public/                # Recursos públicos
│   ├── index.php           # Punto de entrada principal
│   ├── assets/
│   │   ├── style.css
│   │   ├── script.js
│   │   └── logo.png
│
└── README.md               # Documentación del proyecto

Base de datos compartida

Para importar la base de datos:

1. Abre phpMyAdmin
2. Crea una base llamada `sigtafmo`
3. Ve a la pestaña **Importar**
4. Selecciona el archivo `database/proyecto-TOO.sql`
5. Haz clic en **Continuar**

Ya tendrás acceso a las tablas y datos compartidos.