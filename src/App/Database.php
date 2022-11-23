<?php

namespace App;

use PDO;

class Database {
  private string $db;
  private string $host;
  private string $port;
  private string $user;
  private string $password;

  public function __construct() {
    $this->db = "miniforms";
    $this->host = "localhost";
    $this->port = "3306";
    $this->user = "root";
    $this->password = "Alucard29+";
  }

  public function get_conn(): PDO {
    return new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
  }
}

?>