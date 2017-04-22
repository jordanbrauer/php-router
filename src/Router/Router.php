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
}
