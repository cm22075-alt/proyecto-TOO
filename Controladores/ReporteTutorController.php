<?php
// Controladores/ReporteTutorController.php

// Incluir los modelos necesarios
require_once __DIR__ . '/../Modelos/ReporteTutor.php';
require_once __DIR__ . '/../Modelos/Tutor.php';
require_once __DIR__ . '/../Modelos/Asignatura.php';

class ReporteTutorController
{
    private $reporteModelo;
    private $tutorModelo;
    private $asignaturaModelo;

    public function __construct()
    {
        // Instanciar los modelos necesarios
        $this->reporteModelo = new ReporteTutor();
        $this->tutorModelo = new Tutor();
        $this->asignaturaModelo = new Asignatura();
    }

    // =======================================================
    // MÉTODO LISTAR - Muestra el formulario de filtros
    // (Ruta: GET /reportes)
    // =======================================================
    public function listar()
    {
        // Obtener datos para los select del formulario
        $tutores = $this->tutorModelo->listar();
        $asignaturas = $this->asignaturaModelo->listar();
        
        // Convertir array a mysqli_result si es necesario para la vista
        // El modelo Asignatura retorna array, pero la vista espera mysqli_result
        // Así que necesitamos una solución temporal o actualizar la vista
        
        // Cargar vista del formulario de filtros
        $titulo = 'Reporte por Tutor';
        $vista = 'reportes/filtroReporteTutor.php';
        require __DIR__ . '/../vistas/plantillas/layout.php';
    }

    // =======================================================
    // MÉTODO GENERAR - Genera el reporte con los filtros
    // (Ruta: GET /reportes/generar)
    // =======================================================
    public function generar()
    {
        // Obtener parámetros de la URL
        $id_tutor = $_GET['id_tutor'] ?? null;
        $fecha_inicio = $_GET['fecha_inicio'] ?? null;
        $fecha_fin = $_GET['fecha_fin'] ?? null;
        $id_asignatura = $_GET['id_asignatura'] ?? null;
        
        // Validar que se haya seleccionado un tutor
        if (!$id_tutor) {
            $error = "Debe seleccionar un tutor";
            $tutores = $this->tutorModelo->listar();
            $asignaturas = $this->asignaturaModelo->listar();
            
            $titulo = 'Reporte por Tutor';
            $vista = 'reportes/filtroReporteTutor.php';
            require __DIR__ . '/../vistas/plantillas/layout.php';
            return;
        }
        
        // Generar el reporte
        $resultado = $this->reporteModelo->generarReporte(
            $id_tutor, 
            $fecha_inicio, 
            $fecha_fin, 
            $id_asignatura
        );
        
        // Obtener información del tutor
        $tutorInfo = $this->tutorModelo->obtener($id_tutor);
        
        // Obtener estadísticas
        $estadisticas = $this->reporteModelo->obtenerEstadisticas(
            $id_tutor,
            $fecha_inicio,
            $fecha_fin,
            $id_asignatura
        );
        
        // Recargar listas para mantener los select poblados
        $tutores = $this->tutorModelo->listar();
        $asignaturas = $this->asignaturaModelo->listar();
        
        // Cargar vista de resultados
        $titulo = 'Resultado del Reporte';
        $vista = 'reportes/resultadoReporteTutor.php';
        require __DIR__ . '/../vistas/plantillas/layout.php';
    }

    // =======================================================
    // MÉTODO EXPORTAR CSV
    // (Ruta: GET /reportes/exportar_csv)
    // =======================================================
    public function exportar_csv()
    {
        $id_tutor = $_GET['id_tutor'] ?? null;
        $fecha_inicio = $_GET['fecha_inicio'] ?? null;
        $fecha_fin = $_GET['fecha_fin'] ?? null;
        $id_asignatura = $_GET['id_asignatura'] ?? null;
        
        if (!$id_tutor) {
            echo "Error: Debe seleccionar un tutor";
            exit;
        }
        
        $this->reporteModelo->exportarCSV(
            $id_tutor, 
            $fecha_inicio, 
            $fecha_fin, 
            $id_asignatura
        );
    }

    // =======================================================
    // MÉTODO EXPORTAR PDF
    // (Ruta: GET /reportes/exportar_pdf)
    // =======================================================
    public function exportar_pdf()
    {
        $id_tutor = $_GET['id_tutor'] ?? null;
        $fecha_inicio = $_GET['fecha_inicio'] ?? null;
        $fecha_fin = $_GET['fecha_fin'] ?? null;
        $id_asignatura = $_GET['id_asignatura'] ?? null;
        
        if (!$id_tutor) {
            echo "Error: Debe seleccionar un tutor";
            exit;
        }
        
        $this->reporteModelo->exportarPDF(
            $id_tutor, 
            $fecha_inicio, 
            $fecha_fin, 
            $id_asignatura
        );
    }
}