<?php
//Trayendo el paquete de conecion con la db
require_once 'connection/connection.php';

$dbConnection = DatabaseConnection::getInstance();
$connection = $dbConnection->getConnection();

$query = "SELECT * FROM estudiantes";
$result = $connection->query($query);

if ($result) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Obtener los datos de cada estudiante
        $codEstudiante = $row['cod_est'];
        $nombreEstudiante = $row['nomb_est'];

        // Hacer algo con los datos obtenidos
        echo "Código de estudiante: " . $codEstudiante . "<br>";
        echo "Nombre de estudiante: " . $nombreEstudiante . "<br>";
        echo "<br>";
    }
} else {
    echo "Error en la consulta";
}

$dbConnection = null;

?>