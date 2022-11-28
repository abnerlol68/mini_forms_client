<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'Config.php';

use App\Application;

try {
  $app = new Application();
  $app->run();
} catch (\Throwable $th) {
  echo '<pre>';
    echo $th;
  echo '</pre>';
}

?>