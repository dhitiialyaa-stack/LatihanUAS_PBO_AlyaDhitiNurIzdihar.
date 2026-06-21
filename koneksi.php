<?php

class koneksi {
    private $host = "localhost";
    private $db_name = "DB_LatihanUAS_PBO_TI1C_AlyaDhitiNurIzdihar";
    private $username = "root";   // sesuaikan dengan kredensial MySQL Anda
    private $password = "";       // sesuaikan dengan kredensial MySQL Anda
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }

        return $this->conn;
    }
}