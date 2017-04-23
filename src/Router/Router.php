<?php

namespace Jorb\Router;

class Router
{
  private $uri;
  private $methods;

  public function __construct ()
  {
    $this->uri = array();
    $this->methods = array();
  }

  /**
   * Add a URI to internal $uri array property
   * @param string $uri The URI to be added
   * @param mixed $method The method associated with a new URI
   * @return object
   */
  public function add ($uri, $method)
  {
    array_push($this->uri, $uri);
    array_push($this->methods, $method);

    return $this;
  }

  /**
   * Dispatch a request if all validation is met
   */
  public function dispatch ()
  {
    $request = isset($_GET['uri']) ? rtrim("/{$_GET['uri']}", '/') : '/';
    $args = array();

    // BUG: error thrown for every non-matching route
    foreach ($this->uri as $id => $route) {
      if (preg_match("#^{$route}$#", $request)) {
        $uri = explode('/', $request);
        $mock = explode('/', $route);

        echo '<pre>';
        print_r($uri);
        print_r($mock);
        echo '</pre>';

        foreach ($mock as $key => $value) {
          if ($value == '.+') {
            array_push($args, $uri[$key]);
          }
        }

        call_user_func_array($this->methods[$id], $args);
      } else {
        echo "No route for: <code>{$request}</code><br>";
      }
    }
  }
}
