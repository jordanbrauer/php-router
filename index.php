<?php

require_once 'vendor/autoload.php';

use \Jorb\Router\Router as Router;

$router = new Router();

$router
  ->add('/')
  ->add('/about')
  ->add('/contact')
;

$router->dispatch();
