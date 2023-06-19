<?php
//Trayendo el paquete de conecion con la db
require_once __DIR__ . '/../connection/connection.php';

class Estudiantes{

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
    
        if (!$stmt) {
            // Manejar el error en caso de consulta fallida
            $errorInfo = $this->dbConnection->getConnection()->errorInfo();
            echo "Error en la consulta: " . $errorInfo[2];
            return [];
        }
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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