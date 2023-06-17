<?php

class DatabaseConnection
{
    private static $instance;
    private $connection;

    //patron singleton
    private function __construct()
    {
        $host = 'localhost';
        $dbname = 'notas';
        $user = 'postgres';
        $password = 'postgres';

        try {
            $this->connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            //manejo del erro con la conexion a la base de datos
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos notas: " . $e->getMessage());
        }
    }

    //metodo para retornar solo una instancia
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    //metodo con el cual se usa para las consultas 
    public function getConnection()
    {
        return $this->connection;
    }
}


?>