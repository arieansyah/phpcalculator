<?php
namespace Jakmall\Recruitment\Calculator\Database;

class MySQL
{
    protected $db_name = 'calculator';
    protected $db_user = 'root';
    protected $db_pass = 'root.';
    protected $db_host = 'mysql';
    public $koneksi;

    // Open a connect to the database.
    // Make sure this is called on every page that needs to use the database.

    public function database() {
        $this->koneksi = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        return $this->koneksi;
    }

    public function db_query($sql) {
        $conn = $this->koneksi;
        return mysqli_query($conn, $sql);
    }

}
