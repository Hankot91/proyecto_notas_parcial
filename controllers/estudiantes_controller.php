<?php

require_once '/connection/connection.php';
require_once '/models/estudiantes.php';

$dbConnection = DatabaseConnection::getInstance();
$estudiantes = new Estudiantes($dbConnection);

// Manejar la solicitud para agregar un estudiante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $codEstudiante = $_POST['cod_est'];
    $nombreEstudiante = $_POST['nomb_est'];
    $estudiantes->createEstudiante($codEstudiante, $nombreEstudiante);
}

// Manejar la solicitud para obtener todos los estudiantes
$estudiantes = $estudiantes->getAllEstudiantes();

// Renderizar la vista pasando los datos necesarios
require '/view/view.php';

?>
