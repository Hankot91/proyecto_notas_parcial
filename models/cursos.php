<?php

//Trayendo el paquete de conecion con la db
require_once __DIR__ . '/../connection/connection.php';

class Cursos{
    private $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function createCurso($codCurso, $nombreCurso)
    {
        $query = "INSERT INTO cursos (cod_cur, nomb_cur) VALUES (?, ?)";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCurso, $nombreCurso]);
    }

    public function getAllCursos()
    {
        $query = "SELECT * FROM cursos";
        $stmt = $this->dbConnection->getConnection()->query($query);
        $curosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $curosData;
    }

    public function getCurso($codCurso)
    {
        $query = "SELECT * FROM cursos WHERE cod_cur = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCurso]);
        $estudiantesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $estudiantesData;
    }

    public function updateCurso($codCurso, $nombreCurso)
    {
        $query = "UPDATE cursos SET nomb_cur = ? WHERE cod_cur = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$nombreCurso, $codCurso]);
    }

    public function deleteCurso($codCurso)
    {
        $query = "DELETE FROM cursos WHERE cod_cur = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCurso]);
    }
}


?>