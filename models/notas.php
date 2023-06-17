<?php
//Trayendo el paquete de conecion con la db
require_once 'connection/connection.php';

class Notas{

    private $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function createNota($nota, $descripNota, $porcentaje, $posicion)
    {
        $query = "INSERT INTO notas(nota, descrip_nota, porcentaje, posicion) VALUES (?, ?, ?, ?)";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$nota, $descripNota, $porcentaje, $posicion]);
    }

    public function getAllNotas()
    {
        $query = "SELECT * FROM notas";
        $stmt = $this->dbConnection->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateNota($nota, $descripNota, $porcentaje, $posicion)
    {
        /* ¿CONDICIONALES? */
        $query = "UPDATE notas SET nomb_cur = ? WHERE nota = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$nota, $descripNota, $porcentaje, $posicion]);
    }

    public function deleteEstudiante($nota)
    {
        $query = "DELETE FROM notas WHERE nota = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$nota]);
    }

}


?>