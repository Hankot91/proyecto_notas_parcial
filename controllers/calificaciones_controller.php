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
        } elseif (isset($_GET['cod_cur'])) {
            return $this->calificacionesModel->getEstudiantesByCurso($_GET['cod_cur'], $_GET['periodo']);
        }
        return $this->handleReturnAll();
    }
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
        $calificaionExiste = $this->calificacionesModel->getCalificacion($codcalificacion);

        $notaExistente = $this->calificacionesModel->getCalificacion($nota);
        if (!empty($notaExistente) && $notaExistente[0]["nota"] == $nota && $notaExistente[0]["cod_inscripcion"] == $codInscripcion) {
            // El estudiante ya tiene una calificación para esa nota
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.alert('El estudiante ya tiene una calificacion para esa nota.');
                });
            </script>";
        }elseif($calificaionExiste){
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.alert('El código de calificacion ya existe. Por favor, elige otro código.')
                });
            </script>";
        }else {
            try {
                $this->calificacionesModel->createCalificacion($codcalificacion, $valor, $fecha, $codInscripcion, $nota);
            } catch (PDOException $e) {
                if ($e->getCode() === '23514') {
                        echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            window.alert('El valor de la nota solo acepta valores entre 0 y 5.')
                        });
                    </script>";
                } 
            }
        }
    }

    public function handleUpdate()
    {
        $codCalificacion = $_POST['cod_cal'];
        $valor = $_POST['valor'];
        $fecha = $_POST['fecha'];
        $codInscripcion = $_POST['cod_inscripcion'];
        $nota = $_POST['nota'];
        
        $notaExistente = $this->calificacionesModel->getCalificacion($nota);
        
            try {
                $this->calificacionesModel->updateCalificacion($codCalificacion, $valor, $fecha, $codInscripcion, $nota);
            } catch (PDOException $e) {
                if ($e->getCode() === '23514') {
                        echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            window.alert('El valor de la nota solo acepta valores entre 0 y 5.')
                        });
                    </script>";
                } 
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

    public function handleReturnNotas()
    {
        return $this->calificacionesModel->getNotas();
    }

    public function handleReturnNotasByCursos($codCurso)
    {
        return $this->calificacionesModel->getNotasByCurso($codCurso);
    }

}