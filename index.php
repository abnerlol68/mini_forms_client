<?php

require 'Config.php';
require __DIR__ . '/vendor/autoload.php';

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