<?php
class Database {
    private $host = "localhost";
    private $db_name = "bdkusiwasi";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                array(
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                )
            );
            $this->conn->exec("SET NAMES utf8mb4");
            
        } catch(PDOException $exception) {
            // Mostrar error detallado en desarrollo
            error_log("Error de conexión BD: " . $exception->getMessage());
            // En producción, no mostrar detalles al usuario
            echo "Error de conexión: Verifica que MySQL esté corriendo y los datos sean correctos.";
            return null;
        }

        return $this->conn;
    }
}
?>