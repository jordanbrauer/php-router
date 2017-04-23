<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

use \Jorb\Router\Router as Router;

$router = new Router();

$router
  ->add('/', function() {
    echo "<h3>Index</h3>";
  })

  ->add('/about', function() {
    echo "<h3>About</h3>";
  })

  ->add('/contact', function() {
    echo "<h3>Contact</h3>";
  })

  ->add('/user/.+', function($user) {
    echo "<h3>User</h3><p>{$user}</p>";
  })

  ->add('/user/.+/repository/.+', function($user, $repository) {
    echo "<h3>Repository</h3><p>{$user}/{$repository}</p>";
  })
;

$router->dispatch();
