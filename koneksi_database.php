<?php
class Database
{
    private $host = '127.0.0.1';
    private $db_name = 'werehouse_msib';
    private $port = '3306';
    private $username = 'root';
    private $password = '';
    public $conn;


    public function mendapatkan_koneksi()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;port=$this->port", $this->username, $this->password);
            $this->conn->exec("set names utf8");
            // echo "koneksi berhasil";
        } catch (PDOException $err) {
            echo "koneksi gagal :" . $err->getMessage();
        }
        return $this->conn;
    }
}

$database = new Database();
$database->mendapatkan_koneksi();
