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
            if (isset($_GET['buscar'])) {
                return $this->inscripcionesModel->getInscripcion($_GET['buscar']);
            }
        }
            return $this->handleReturnAll();
    }

    public function handleReturnAll()
    {
        return $this->inscripcionesModel->getAllInscripciones();
    }

    public function handleCreate()
    {
        $codInscripcion = $_POST['cod_inscripcion'];
        $periodo = $_POST['periodo'];
        $anho = $_POST['anho'];
        $codCurso = $_POST['cod_cur'];
        $codEstudiante = $_POST['cod_est'];
        $inscripcionExistente = $this->inscripcionesModel->getInscripcion($codInscripcion);
        $estudianteInscripto = $this->inscripcionesModel->getExistenceEstudiante($codCurso, $codEstudiante); 
        if ($inscripcionExistente) {
            // El código de inscripcion ya existe, mostrar mensaje de error
            echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    window.alert('El código de inscripcion ya existe. Por favor, elige otro código.')
                                });
                            </script>";
        } elseif($estudianteInscripto){
                // El código de estudiante ya esta inscrito en ese curso, mostrar mensaje de error
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.alert('El estudiante ya esta inscrito en ese curso.')
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
        $codCursoNew = $_POST['cod_cur'];
        $codEstudianteNew = $_POST['cod_est'];
        
        $this->inscripcionesModel->updateInscripcion($periodoNew, $anhoNew, $codCursoNew, $codEstudianteNew, $codInscripcion);

    }

    public function handleDelete()
    {
        $codInscripcion = $_POST['cod_inscripcion'];
        $this->inscripcionesModel->deleteInscripcion($codInscripcion);
    }

    public function handleReturnCursos()
    {
        return $this->inscripcionesModel->getCursos();
    }

    public function handleReturnEstudiantes()
    {
        return $this->inscripcionesModel->getEstudiantes();
    }

}

?>