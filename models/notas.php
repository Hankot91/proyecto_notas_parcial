<?php
//Trayendo el paquete de conecion con la db
require_once __DIR__ . '/../connection/connection.php';
require_once "cursos.php";

class Notas{

    private $dbConnection;
    private $cursosModel;  
    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
        $this->cursosModel = new Cursos($dbConnection);
    }

    public function createNota($nota, $descripcionNota, $porcentaje, $posicion, $codCurso)
    {
        $query = "INSERT INTO notas (nota, descrip_nota, porcentaje, posicion, cod_cur) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$nota, $descripcionNota, $porcentaje, $posicion, $codCurso]);
    }

    public function getAllNotas()
    {
        $query = "SELECT * FROM notas";
        $stmt = $this->dbConnection->getConnection()->query($query);
        $notasData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $notasData;
    }

    public function getNota($busqueda)
    {
        $query = "SELECT * FROM notas
        WHERE nota ILIKE ? OR
                descrip_nota ILIKE ? OR
                CAST(porcentaje AS TEXT) = ? OR
                CAST(posicion AS TEXT) = ? OR
                CAST(cod_cur AS TEXT) = ?";

        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$busqueda, $busqueda, $busqueda, $busqueda, $busqueda]);
        $notasData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $notasData;
    }

    public function updateNota($nota, $descripcionNota, $porcentaje, $posicion, $codCurso)
    {
        $query = "UPDATE notas SET descrip_nota = ?, porcentaje = ?, posicion = ?, cod_cur = ? WHERE nota = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$descripcionNota, $porcentaje, $posicion, $codCurso, $nota]);
    }

    public function deleteNota($nota)
    {
        $query = "DELETE FROM notas WHERE nota = ?";
        $stmt = $this->dbConnection->getConnection()->prepare($query);
        $stmt->execute([$nota]);
    }

    public function getCursos()
    {
        return $this->cursosModel->getAllCursos();
    }

}


?>