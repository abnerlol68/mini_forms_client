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
    $this->host = "127.0.0.1";
    $this->port = "3306";
    $this->user = "admin_miniforms";
    $this->password = '_^g&zU$E{X3@_,bFy';
  }

  public function get_conn(): PDO {
    return new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
  }
}

?>