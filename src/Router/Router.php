<?php

namespace Jorb\Router;

class Router
{
  private $uri;

  public function __construct ()
  {
    $this->uri = array();
  }

  /**
   * Add a URI to internal $uri array property
   * @param string $uri The URI to be added
   */
  public function add ($uri)
  {
    array_push($this->uri, $uri);
    return $this;
  }

  /**
   * Look for a matching route
   * @param string $uri The url being searched for
   * @param array $routes A list of available routes
   * @return boolean
   */
  public function match ($request, $routes)
  {
    foreach ($routes as $id => $route) {
      if (preg_match("#^{$route}$#", $request)) {
        return true;
      }
    }

    return false;
  }
}
