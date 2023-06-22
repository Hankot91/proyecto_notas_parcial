<?php
//Trayendo el paquete de conecion con la db
require_once __DIR__ . '/../connection/connection.php';
require_once "estudiantes.php";
require_once "cursos.php";

class Inscripciones
{

    private $dbConnection;
    private $cursosModel; 
    private $estudiantesModel;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->cursosModel = new Cursos($dbConnection);
        $this->estudiantesModel = new Estudiantes($dbConnection);
    }

    public function createInscripcion($codInscripcion, $periodo, $anho, $codCurso, $codEstudiante)
    {
        $query = "INSERT INTO inscripciones (cod_inscripcion, periodo, anho, cod_cur, cod_est) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codInscripcion, $periodo, $anho, $codCurso, $codEstudiante]);
    }

    public function getCursos(){
        return $this->cursosModel->getAllCursos();
    }

    public function getEstudiantes(){
        return $this->estudiantesModel->getAllEstudiantes();
    }

    public function getAllInscripciones()
    {
        $query = "SELECT * FROM inscripciones";
        $stmt = $this->dbConnection->getConnection()->query($query);
        $inscripcionesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $inscripcionesData;
    }

    public function getExistenceEstudiante($codCurso, $codEstudiante)
    {
        $query = "SELECT cod_est FROM inscripciones WHERE cod_cur = ? AND cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCurso, $codEstudiante]);
        $codEstudiante = $stmt->fetchColumn();
        return $codEstudiante;
    }

    public function getInsripcion($codInscripcion)
    {
        $query = "SELECT * FROM inscripciones WHERE cod_inscripcion = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codInscripcion]);
        $inscripcionesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $inscripcionesData;
    }

    public function getInscripcionesByEstudiante($codEstudiante)
    {
        $query = "SELECT * FROM inscripciones WHERE cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codEstudiante]);
        $inscripcionesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $inscripcionesData;
    }

    public function getInscripcionByCurso($codCurso)
    {
        $query = "SELECT * FROM inscripciones WHERE cod_cur = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCurso]);
        $inscripcionesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $inscripcionesData;
    }

    public function getInscripcionByAnho($anho)
    {
        $query = "SELECT * FROM inscripciones WHERE anho = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$anho]);
        $inscripcionesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $inscripcionesData;
    }

    public function getInscripcionByPeriodo($perido)
    {
        $query = "SELECT * FROM inscripciones WHERE periodo = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$perido]);
        $inscripcionesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $inscripcionesData;
    }

    public function updateInscripcion($periodoNew, $anhoNew, $codCursoNew, $codEstudianteNew, $codInscripcion)
    {
        $query = "UPDATE inscripciones SET periodo = ?, anho = ?, cod_cur = ?, cod_est = ? WHERE cod_inscripcion = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$periodoNew, $anhoNew, $codCursoNew, $codEstudianteNew, $codInscripcion]);
    }

    public function deleteInscripcion($codInscripcion)
    {
        $query = "DELETE FROM inscripciones WHERE cod_inscripcion = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codInscripcion]);
    }

}