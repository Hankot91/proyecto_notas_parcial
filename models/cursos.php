<?php
//Trayendo el paquete de conecion con la db
require_once 'connection/connection.php';

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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCurso($codCurso, $nombreCurso)
    {
        $query = "UPDATE cursos SET nomb_cur = ? WHERE cod_cur = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$nombreCurso, $codCurso]);
    }

    public function deleteEstudiante($codCurso)
    {
        $query = "DELETE FROM cursos WHERE cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCurso]);
    }

}


?>