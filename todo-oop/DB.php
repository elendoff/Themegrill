<?php

class DB
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'todo';
    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            echo "connection failed";
        } else {
            // return $this->conn;
        }
    }
    public function insert($sql)
    {
        $ret = mysqli_query($this->conn, $sql);
        return $ret;
    }
    public function get_data($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function delete($sql)
    {
        $delete = mysqli_query($this->conn, $sql);
        return $delete;
    }
}
