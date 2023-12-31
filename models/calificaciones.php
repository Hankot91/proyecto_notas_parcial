<?php
//Trayendo el paquete de conecion con la db
require_once __DIR__ . '/../connection/connection.php';
require_once "notas.php";
require_once "inscripciones.php";
class Calificaciones{

    private $dbConnection;
    private $notasModel;
    private $inscripcionesModel;
    private $estudiantesModel;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->notasModel = new Notas($dbConnection);
        $this->inscripcionesModel = new Inscripciones($dbConnection);
        $this->estudiantesModel = new Estudiantes($dbConnection);
    }

    public function createCalificacion($codCalificacion, $valor, $fecha, $codInscripcion, $nota)
    {
        $query = "INSERT INTO calificaciones (cod_cal, valor, fecha, cod_inscripcion, nota) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCalificacion, $valor, $fecha, $codInscripcion, $nota]);
    }

    public function getAllCalificaciones()
    {
        $query = "SELECT * FROM calificaciones";
        $stmt = $this->dbConnection->getConnection()->query($query);
        $calificacionesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $calificacionesData;
    }

    public function getCalificacion($busqueda)
    {
        $query = "SELECT * FROM calificaciones
        WHERE CAST(cod_cal AS TEXT) LIKE ? OR
                CAST(valor AS TEXT) LIKE ? OR
                CAST(fecha AS TEXT) LIKE ? OR
                CAST(cod_inscripcion AS TEXT) LIKE ? OR
                CAST(nota AS TEXT) LIKE ?";

        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $searchValue = "%{$busqueda}%"; 
        $stmt->execute([$searchValue, $searchValue, $searchValue, $searchValue, $searchValue]);
        $calificacionData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $calificacionData;
    }
    
    public function updateCalificacion($codCalificacion, $valor, $fecha, $codInscripcion, $nota)
    {
        $query = "UPDATE calificaciones SET valor = ?, fecha = ?, cod_inscripcion = ?, nota = ? WHERE cod_cal = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$valor, $fecha, $codInscripcion, $nota, $codCalificacion]);
    }

    public function deleteCalificacion($codCalificacion)
    {
        $query = "DELETE FROM calificaciones WHERE cod_cal = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCalificacion]);
    }

    public function getCursos()
    {
        return $this->inscripcionesModel->getCursos();
    }

    public function getInscripcion()
    {
        return $this->inscripcionesModel->getAllInscripciones();
    }

    public function getNotas()
    {
        return $this->notasModel->getAllNotas();
    }
    
    public function getEstudiantes()
    {
        return $this->estudiantesModel->getAllEstudiantes();
    } 

    public function getEstudiantesByCurso($codCurso, $periodo)
    {
        try {
            $query = "SELECT e.nomb_est, i.cod_inscripcion 
                    FROM estudiantes e 
                    INNER JOIN inscripciones i ON e.cod_est = i.cod_est 
                    INNER JOIN cursos c ON i.cod_cur = c.cod_cur
                    WHERE i.cod_cur = ? AND i.periodo = ?";
        
            $stmt = $this->dbConnection->getConnection()->prepare($query);
            $stmt->execute([$codCurso, $periodo]);    
            $estudiantesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $estudiantesData;
        } catch (PDOException $e) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                window.alert('Algo salio mal con el registro, intentelo de nuevo.');
            });
        </script>";
        }
    }

    public function getNotasByCurso($codCurso)
    {
        $query = "SELECT * FROM notas WHERE cod_cur = ?";
            
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$codCurso]);    
        $notasData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $notasData;
    }

}


?>