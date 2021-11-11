<?php

//class voor DataBase dit connenct met de Database
class Database{
   private $host     = 'localhost';
   private $db       = 'schelden';
   private $user     = 'root';
   private $password = '';
   public $conn;
   public $options;

   public function __construct(){
      $this->getConnection();
   }
   
   public function getConnection(){
      $dsn = "mysql:host=$this->host;dbname=$this->db;charset=UTF8";
      $this->options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
      $this->conn = new PDO($dsn, $this->user, $this->password, $this->options);

      return $this->conn;
   }
}