<?php
require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../models/estudiantes.php';

$dbConnection = DatabaseConnection::getInstance();
$estudiantesModel = new Estudiantes($dbConnection);

// Manejar la solicitud para agregar un estudiante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $codEstudiante = $_POST['cod_est'];
    $nombreEstudiante = $_POST['nomb_est'];
    $estudiantesModel->createEstudiante($codEstudiante, $nombreEstudiante);
}

// Manejar la solicitud para actualizar un estudiante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $codEstudiante = $_POST['cod_est'];
    $nombreEstudiante = $_POST['nomb_est'];
    $estudiantesModel->updateEstudiante($codEstudiante, $nombreEstudiante);
}

// Manejar la solicitud para eliminar un estudiante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $codEstudiante = $_POST['cod_est'];
}

// Obtener todos los estudiantes
$estudiantesData = $estudiantesModel->getAllEstudiantes();
var_dump($estudiantesData);

// Renderizar la vista pasando los datos necesarios
require __DIR__ . '/../index.php';
exit();

?>
