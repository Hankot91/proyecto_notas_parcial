<?php
//Trayendo el paquete de conecion con la db
require_once 'connection/connection.php';

class Inscripciones{

    private $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function createCalificacion($cod_cal, $valor, $fecha, $cod_cur, $cod_est, $periodo, $year, $nota)
    {
        $query = "INSERT INTO calificaciones (cod_cal, valor, fecha, cod_cur, cod_est, periodo, year, nota) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$cod_cal, $valor, $fecha, $cod_cur, $cod_est, $periodo, $year, $nota]);
    }

    public function getAllCalificaciones()
    {
        $query = "SELECT * FROM calificaciones";
        $stmt = $this->dbConnection->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCalificacion($cod_cal, $valor, $fecha, $cod_cur, $cod_est, $periodo, $year, $nota)
    {   
        /* modificar consulta, ¿condicional? */
        $query = "UPDATE calificaciones SET nomb_est = ? WHERE cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$periodo, $year,$cod_cur,$cod_est]);
    }

    public function deleteCalificacion($cod_cal)
    {
        $query = "DELETE FROM calificaciones WHERE cod_cal = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$cod_cal]);
    }

}


?>