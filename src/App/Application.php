<?php

namespace App;

class Application {
  private Router $router;

  public function __construct() {
    $this->router = new Router();
  }
  
  public function run(): void {
    session_start();
    $uri = $this->router->get_uri();
//    var_dump($uri);
    $this->router->redirect($uri);
  }
}

?>
