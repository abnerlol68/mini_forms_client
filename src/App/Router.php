<?php

namespace App;

class Router {
  public function __construct() {
  }

  public function get_uri(): string {
    return rtrim(isset($_GET['url']) ? $_GET['url'] : null, '/');
  }

  public function redirect($uri): void {
    $ADDRESS = [
      'login'     => ROOT . 'src/View/Login.php',
      'form'      => ROOT . 'src/View/Form.php',
      'submit'    => ROOT . 'src/Controller/Form.php',
      'thanks'    => ROOT . 'src/View/ThanksForResponse.php',
      'not_found' => ROOT . 'src/View/NotFound.php',
    ];
    
    if ($uri == 'request') {
      $request = new Request();
      $request->response();
      return;
    }

    if (!isset($_SESSION["user"])) {
      require $ADDRESS['login'];
      return;
    }
  
    // If uri is null, the request uri is point to home
    if (!$uri) {
      require $ADDRESS['login'];
      return;
    }

    // If the uri is not found in addresses, NotFound is pointed to
    if (!array_key_exists($uri, $ADDRESS)) {
      require $ADDRESS['not_found'];
      return;
    }
  
    // The request uri is point to address select
    require $ADDRESS[$uri];
    return;
  }
}

?>
