<?php

require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../models/inscripciones.php';
require_once "../controllers/controller.php";


class InscripcionesController implements Controller
{

    private $dbConnection;
    private $inscripcionesModel;

    public function __construct()
    {
        $this->dbConnection = DatabaseConnection::getInstance();
        $this->inscripcionesModel = new Inscripciones($this->dbConnection);
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
            if (isset($_GET['cod_est'])) {
                return $this->inscripcionesModel->getInscripcionesByEstudiante($_GET['cod_est']);
            } elseif ($_GET['cod_cur']) {
                return $this->inscripcionesModel->getInscripcionByCurso($_GET['cod_cur']);
            } elseif ($_GET['anho']) {
                return $this->inscripcionesModel->getInscripcionByAnho($_GET['anho']);
            } elseif ($_GET['periodo']) {
                return $this->inscripcionesModel->getInscripcionByPeriodo($_GET['periodo']);
            } elseif ($_GET['cod_inscripcion']) {
                return $this->inscripcionesModel->getInsripcion($_GET['cod_inscripcion']);
            }
        }
        return $this->handleReturnAll();
    }

    public function handleReturnAll()
    {
        return $this->inscripcionesModel->getAllInscripciones();
    }

    public function handleReturnCursos(){
        return $this->inscripcionesModel->getCursos();
    }

    public function handleReturnEstudiantes(){
        return $this->inscripcionesModel->getEstudiantes();
    }

    public function handleCreate()
    {
        $codInscripcion = $_POST['cod_inscripcion'];
        $periodo = $_POST['periodo'];
        $anho = $_POST['anho'];
        $codCurso = $_POST['cod_cur'];
        $codEstudiante = $_POST['cod_est'];
        $inscripcionExistente = $this->inscripcionesModel->getInsripcion($codInscripcion);
        $estudianteInscripto = $this->inscripcionesModel->getExistenceEstudiante($codCurso, $codEstudiante); 
        if ($inscripcionExistente) {
            // El código de inscripcion ya existe, mostrar mensaje de error
            echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                            let parrafo = document.querySelector('.mensaje_error');
                                            if (parrafo) {
                                            parrafo.textContent = 'El código de inscripcion ya existe. Por favor, elige otro código.';
                                        }
                                });
                            </script>";
        } elseif($estudianteInscripto){
                // El código de estudiante ya esta inscrito en ese curso, mostrar mensaje de error
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                            let parrafo = document.querySelector('.mensaje_error');
                            if (parrafo) {
                            parrafo.textContent = 'El estudiante ya esta inscrito en este curso';
                        }
                });
            </script>";
        } else {
            $this->inscripcionesModel->createInscripcion($codInscripcion, $periodo, $anho, $codCurso, $codEstudiante);
        }
    }

    public function handleUpdate()
    {
        $codInscripcion = $_POST['cod_inscripcion'];
        $periodoNew = $_POST['periodo'];
        $anhoNew = $_POST['anho'];
        $codCursoNew = $_POST['cod_curso'];
        $codEstudianteNew = $_POST['cod_est'];
        $this->inscripcionesModel->updateInscripcion($periodoNew, $anhoNew, $codCursoNew, $codEstudianteNew, $codInscripcion);
    }

    public function handleDelete()
    {
        $codInscripcion = $_POST['cod_inscripcion'];
        $this->inscripcionesModel->deleteInscripcion($codInscripcion);
    }
}

?>