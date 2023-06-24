<?php
//Trayendo el paquete de conecion con la db
require_once __DIR__ . '/../connection/connection.php';

class Estudiantes
{

    private $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function createEstudiante($codEstudiante, $nombreEstudiante)
    {
        $query = "INSERT INTO estudiantes (cod_est, nomb_est) VALUES (?, ?)";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codEstudiante, $nombreEstudiante]);
    }

    public function getAllEstudiantes()
    {
        $query = "SELECT * FROM estudiantes";
        $stmt = $this->dbConnection->getConnection()->query($query);
        $estudiantesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $estudiantesData;
    }

    public function getEstudiante($busqueda)
    {
        $query = "SELECT * FROM estudiantes WHERE CAST(cod_est AS TEXT) = ? OR nomb_est ILIKE ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $searchValue = '%' . $busqueda . '%';
        $stmt->execute([$busqueda, $searchValue]);
        $estudianteData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $estudianteData;
    }
    


    public function updateEstudiante($codEstudiante, $nombreEstudiante)
    {
        $query = "UPDATE estudiantes SET nomb_est = ? WHERE cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$nombreEstudiante, $codEstudiante]);
    }

    public function deleteEstudiante($codEstudiante)
    {
        $query = "DELETE FROM estudiantes WHERE cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codEstudiante]);
    }

}


?>