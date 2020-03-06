<?php

class Router {

  private $controllers = array();

  public function agregarController($path, $controller) {
    if (empty($this->controllers[$path])) {
      $this->controllers[$path] = $controller;
      return true;
    }
    return false;
  }

  public function deleteController($path) {
    if (!empty($this->controllers[$path])) {
      unset($this->controllers[$path]);
      return true;
    }
    return false;
  }

  public function dispatch($path) {
    if (empty($this->controllers[$path])) {
      return false;
    }
    return $this->controllers[$path];
  }
}