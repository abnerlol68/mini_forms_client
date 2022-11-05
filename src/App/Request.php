<?php

namespace App;

use PDO;

class Request {
  private PDO $conn;

  public function __construct() {
    $db = new Database();
    $this->conn = $db->get_conn();
  }

  public function response() {
    

    echo 'Operation not available';
    http_response_code(400);
    return;
  }
}

?>