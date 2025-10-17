/SIGTAFMO/
├── /config/                # Configuración global
│   └── db.php              # Conexión a la base de datos
│   └── constantes.php      # Constantes del sistema (roles, estados)
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
│   ├── EstudianteController.php
│   ├── TutorController.php
│   ├── AsignaturaController.php
│   ├── UsuarioController.php
│   ├── SesionController.php
│   ├── ReporteController.php
│   └── AuthController.php
│
├── /views/                 # VISTA: interfaz de usuario
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
│   ├── /layouts/
│   │   ├── header.php
│   │   ├── footer.php
│   │   └── navbar.php
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
