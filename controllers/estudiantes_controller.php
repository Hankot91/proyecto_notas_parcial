<?php

require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../models/estudiantes.php';
require_once "controller.php";

class EstudiantesController implements Controller
{
    private $dbConnection;
    private $estudiantesModel;

    public function __construct()
    {
        $this->dbConnection = DatabaseConnection::getInstance();
        $this->estudiantesModel = new Estudiantes($this->dbConnection);
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
                return $this->estudiantesModel->getEstudiante($_GET['buscar']);
            }
        }
        return $this->handleReturnAll();
    }

    public function handleReturnAll()
    {
        return $this->estudiantesModel->getAllEstudiantes();
    }

    public function handleCreate()
    {
        $codEstudiante = $_POST['cod_est'];
        $nombreEstudiante = $_POST['nomb_est'];
        $estudianteExistente = $this->estudiantesModel->getEstudiante($codEstudiante);

        if ($estudianteExistente) {
            // El código de estudiante ya existe, mostrar mensaje de error
            echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                window.alert('El código de estudiante ya existe. Por favor, elige otro código')
                            });
                        </script>";
        } else {
            $this->estudiantesModel->createEstudiante($codEstudiante, $nombreEstudiante);
        }
    }


    public function handleUpdate()
    {
        $codEstudiante = $_POST['cod_est'];
        $nombreEstudiante = $_POST['nomb_est'];
        $this->estudiantesModel->updateEstudiante($codEstudiante, $nombreEstudiante);
    }

    public function handleDelete()
    {
        $codEstudiante = $_POST['cod_est'];
        $this->estudiantesModel->deleteEstudiante($codEstudiante);
    }
}

?>