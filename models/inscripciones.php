<?php
//Trayendo el paquete de conecion con la db
require_once 'connection/connection.php';

class Inscripciones{

    private $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function createInscripcion($periodo, $year,$cod_cur,$cod_est)
    {
        $query = "INSERT INTO inscripciones (periodo, year, cod_cur, cod_est) VALUES (?,?,?,?)";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$periodo, $year, $cod_cur, $cod_est]);
    }

    public function getAllInscripciones()
    {
        $query = "SELECT * FROM inscripciones";
        $stmt = $this->dbConnection->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateInscripcion($periodo, $year,$cod_cur,$cod_est)
    {   
        /* modificar consulta, ¿condicional? */
        $query = "UPDATE inscripciones SET nomb_est = ? WHERE cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$periodo, $year,$cod_cur,$cod_est]);
    }

    public function deleteInscripcion($cod_cur,$cod_est)
    {
        $query = "DELETE FROM inscripciones WHERE cod_cur = ? AND cod_est = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$cod_cur,$cod_est]);
    }

}


?>