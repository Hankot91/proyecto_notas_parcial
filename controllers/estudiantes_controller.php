<?php

require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../models/estudiantes.php';

class EstudiantesController {
    private $dbConnection;
    private $estudiantesModel;

    public function __construct() {
        $this->dbConnection = DatabaseConnection::getInstance();
        $this->estudiantesModel = new Estudiantes($this->dbConnection);
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['agregar'])) {
                $this->handleAgregarEstudiante();
            } elseif (isset($_POST['actualizar'])) {
                $this->handleActualizarEstudiante();
            } elseif (isset($_POST['eliminar'])) {
                $this->handleEliminarEstudiante();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_GET['cod_est'])){
                return $this->estudiantesModel->getEstudiante($_GET['cod_est']);
            }
        }
        return $this->handleReturnAll();
        //$estudiantesData = $this->estudiantesModel->getAllEstudiantes();
        //require __DIR__ . '/../views/estudiantes_view.php';
    }

    public function handleReturnAll(){
        return $this->estudiantesModel->getAllEstudiantes();
    }

    private function handleAgregarEstudiante() {
        $codEstudiante = $_POST['cod_est'];
        $nombreEstudiante = $_POST['nomb_est'];
        $this->estudiantesModel->createEstudiante($codEstudiante, $nombreEstudiante);
    }

    private function handleActualizarEstudiante() {
        $codEstudiante = $_POST['cod_est'];
        $nombreEstudiante = $_POST['nomb_est'];
        $this->estudiantesModel->updateEstudiante($codEstudiante, $nombreEstudiante);
    }

    private function handleEliminarEstudiante() {
        $codEstudiante = $_POST['cod_est'];
        $this->estudiantesModel->deleteEstudiante($codEstudiante);
    }
}

