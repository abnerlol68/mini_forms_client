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
    $this->db       = DB_NAME;
    $this->host     = DB_HOST;
    $this->port     = DB_PORT;
    $this->user     = DB_USER;
    $this->password = DB_PASS;
  }

  public function get_conn(): PDO {
    return new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
  }
}

?>