<?php

namespace Jorb\Router;

class Router
{
  private $routes;
  private $methods;
  private $request;
  private $args;

  public function __construct ()
  {
    $this->routes = array();
    $this->methods = array();
    $this->request = isset($_GET['uri']) ? rtrim("/{$_GET['uri']}", '/') : '/';
    $this->args = array();
  }

  /**
   * Add a URI to internal $uri array property
   * @param string $uri The URI to be added
   * @param mixed $method The method associated with a new URI
   * @return object
   */
  public function add ($route, $method)
  {
    array_push($this->routes, $route);
    array_push($this->methods, $method);

    return $this;
  }

  /**
   * Dispatch a request if all validation is met
   */
   // BUG: will match multiple routes if a longer route contains a short route in its' path
  public function dispatch ()
  {
    $matchCount = $diffCount = 0;
    $matches = $differs = array();

    foreach ($this->routes as $id => $route) {
      if (preg_match("#^{$route}$#", $this->request)) {
        $matchCount++;
        $matches[$id] = $route;
      } else {
        $diffCount++;
        $differs[$id] = $route;
      }
    }

    if (count($matches) <= 0) {
      http_response_code(404);
      echo "<h1>404</h1>";
      throw new \Exception("No route was found for: {$this->request}");
      die;
    } elseif (count($matches) > 1) {
      http_response_code(500);
      die("Looks like there is a problem trying to find the right location... Stupid devs....");
    } elseif (count($matches) === 1) {
      foreach ($matches as $id => $match) {
        $request = explode('/', $this->request);
        $slugs = explode('/', $match);

        foreach ($slugs as $key => $slug) {
          if ($slug == '.+') {
            array_push($this->args, $request[$key]);
          }
        }

        call_user_func_array($this->methods[$id], $this->args);
      }
    }
  }
}
