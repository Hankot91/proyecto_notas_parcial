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

    public function getAllInscripciones()
    {
        $query = "SELECT * FROM inscripciones";
        $stmt = $this->dbConnection->getConnection()->query($query);
        $inscripcionesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $inscripcionesData;
    }
    
    
    public function getInscripcion($busqueda)
    {
        $query = "SELECT * FROM inscripciones 
                WHERE cod_inscripcion = ? OR
                        periodo = ? OR
                        anho = ? OR
                        cod_cur = ? OR
                        cod_est = ?";
    
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$busqueda, $busqueda, $busqueda, $busqueda, $busqueda]);
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

    public function getCursos(){
        return $this->cursosModel->getAllCursos();
    }
    
    public function getEstudiantes(){
        return $this->estudiantesModel->getAllEstudiantes();
    }
    
    public function getExistenceEstudiante($codCurso, $codEstudiante)
    {
        $query = "SELECT cod_est FROM inscripciones WHERE cod_cur = ? AND cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCurso, $codEstudiante]);
        $codEstudiante = $stmt->fetchColumn();
        return $codEstudiante;
    }

}