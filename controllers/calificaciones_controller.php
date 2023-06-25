<?php

require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../models/calificaciones.php';
require_once "controller.php";

class CalificacionesController implements Controller{

    private $dbConnection;
    private $calificacionesModel;

    public function __construct()
    {
        $this->dbConnection = DatabaseConnection::getInstance();
        $this->calificacionesModel = new Calificaciones($this->dbConnection);
    }
    
    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['agregar'])) {
                $this->handleCreate();
            } elseif (isset($_POST['actualizar'])) {
                $this->handleUpdate();
            } elseif (isset($_POST['eliminar'])) {
                $this->handleDelete();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['buscar'])) {
                return $this->calificacionesModel->getCalificacion($_GET['buscar']);
            }
        }
            return $this->handleReturnAll();
    }

    public function handleReturnAll()
    {
        return $this->calificacionesModel->getAllCalificaciones();
    }

    public function handleCreate()
    {
        $codcalificacion = $_POST['cod_cal'];
        $valor = $_POST['valor'];
        $fecha = $_POST['fecha'];
        $codInscripcion = $_POST['cod_inscripcion'];
        $nota = $_POST['nota'];
        $notaExistente = $this->calificacionesModel->getNota($nota);

        if($notaExistente){
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.alert('El estudiante ya tiene una calificacion para esa nota.')
                });
            </script>";
        } else {
            $this->calificacionesModel->createCalificacion($codcalificacion, $valor, $fecha, $codInscripcion, $nota);
        }
    }

    public function handleUpdate()
    {
        $codcalificacion = $_POST['cod_cal'];
        $valor = $_POST['valor'];
        $fecha = $_POST['fecha'];
        $codInscripcion = $_POST['cod_inscripcion'];
        $nota = $_POST['nota'];
        $notaExistente = $this->calificacionesModel->getNota($nota);

        if($notaExistente){
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.alert('El estudiante ya tiene una calificacion para esa nota.')
                });
            </script>";
        } else {
            $this->calificacionesModel->updateCalificacion($codcalificacion, $valor, $fecha, $codInscripcion, $nota);
        }
    }
    
    public function handleDelete()
    {
        $codCalificacion = $_POST['cod_cal'];
        $this->calificacionesModel->deleteCalificacion($codCalificacion);
    }

    public function handleReturnCursos()
    {
        return $this->calificacionesModel->getCursos();
    }

    public function handleReturnInscripciones(){
        $codCurso = $_POST['cod_cur'];
        return $this->calificacionesModel->getInscripcion($codCurso);
    }

}