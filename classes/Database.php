<?php 

class Database{
    private  $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db = 'japanese_dictionary';
    public $conn;


    public function __construct(){



        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->db);

        if($this->conn->connect_error){
            die($this->conn->connect_error);
        }else{
            return $this->conn;
        }

    






    }







}

























?>