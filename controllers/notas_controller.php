<?php

require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../models/notas.php';
require_once "../controllers/controller.php";


class NotasController implements Controller
{
    private $dbConnection;
    private $notasModel;

    public function __construct()
    {
        $this->dbConnection = DatabaseConnection::getInstance();
        $this->notasModel = new Notas($this->dbConnection);
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
                return $this->notasModel->getNota($_GET['buscar']);
            }
        }
            return $this->handleReturnAll();
    }

    public function handleReturnAll()
    {
        return $this->notasModel->getAllNotas();
    }

    public function handleReturnCursos(){
        return $this->notasModel->getCursos();
    }

    public function handleCreate()
    {
        $nota = $_POST['nota'];
        $descripcionNota = $_POST['descrip_nota'];
        $porcentaje = $_POST['porcentaje'];
        $posicion = $_POST['posicion'];
        $codCurso = $_POST['cod_cur'];
        $notaExistente = $this->notasModel->getNota($nota);
        if ($porcentaje > 100){
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                window.alert('El porcentaje no puede superar el 100%');
            });
        </script>";
        }elseif ($notaExistente) {
            // El código de nota ya existe, mostrar mensaje de error
            echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    window.alert('El código de notas ya existe. Por favor, elige otro código.');
                                });
                            </script>";
        } else {
            try {
                $this->notasModel->createNota($nota, $descripcionNota, $porcentaje, $posicion, $codCurso);
            } catch (PDOException $e) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.alert('Error: La suma de porcentajes para el curso supera el 100%.');
                });
            </script>";
            }
        }
    }

    public function handleUpdate()
    {
        $nota = $_POST['nota'];
        $descripcionNota = $_POST['descrip_nota'];
        $porcentaje = $_POST['porcentaje'];
        $posicion = $_POST['posicion'];
        $codCurso = $_POST['cod_cur'];
        try {
            $this->notasModel->updateNota($nota, $descripcionNota, $porcentaje, $posicion, $codCurso);     
        } catch (PDOException $e) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                window.alert('Error: La suma de porcentajes para el curso no debe superar el 100%.');
            });
        </script>";
        }
    }

    public function handleDelete()
    {
        $nota = $_POST['nota'];
        $this->notasModel->deleteNota($nota);
    }

}


?>