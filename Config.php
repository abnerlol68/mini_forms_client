<?php
  $env = Dotenv\Dotenv::createImmutable(__DIR__);
  $env->load();
  define('URL', 'http://localhost/mini_forms_client/');
  define('ROOT', __DIR__.'/');
  define('DB_NAME', $_ENV['DB_NAME']);
  define('DB_HOST', $_ENV['DB_HOST']);
  define('DB_PORT', $_ENV['DB_PORT']);
  define('DB_USER', $_ENV['DB_USER']);
  define('DB_PASS', $_ENV['DB_PASS']);
?>