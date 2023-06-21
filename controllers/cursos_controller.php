<?php

require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../models/cursos.php';
require_once "../controllers/controller.php";
class cursosController implements Controller{
    private $dbConnection;
    private $cursosModel;

    public function __construct() {
        $this->dbConnection = DatabaseConnection::getInstance();
        $this->cursosModel = new Cursos($this->dbConnection);
    }

    public function handleRequest(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['agregar'])) {
                $this->handleCreate();
            }elseif (isset($_POST['actualizar'])) {
                $this->handleUpdate();
            } elseif (isset($_POST['eliminar'])) {
                $this->handleDelete();
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_GET['cod_cur'])){
                return $this->cursosModel->getCurso($_GET['cod_cur']);
            }
        }
        return $this->handleReturnAll();
    }

    public function handleReturnAll(){
        return $this->cursosModel->getAllCursos();
    }

    public function handleCreate(){
        $codCurso = $_POST['cod_cur'];
        $nombreCurso = $_POST['nomb_cur'];
        $this->cursosModel->createCurso($codCurso, $nombreCurso);
    }

    public function handleUpdate(){
        $codCurso = $_POST['cod_cur'];
        $nombreCurso = $_POST['nomb_cur'];
        $this->cursosModel->updateCurso($codCurso, $nombreCurso);
    }

    public function handleDelete(){
        $codCurso = $_POST['cod_cur'];
        $this->cursosModel->deleteCurso($codCurso);
    }

}