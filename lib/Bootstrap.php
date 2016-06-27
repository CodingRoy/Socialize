<?php
class Bootstrap {

  private $_url = null;
  private $_controller = null;

  // Initialize (Run) the bootstrap
  function init() {
    $this->_getUrl();
    $this->_loadController();
    $this->_callController();
}

  // $_Get the URL and Fetches
  private function _getUrl() {
    $url = isset($_GET['url']) ? $_GET['url'] : 'index';
    $this->_url = explode('/', trim($url, '/'));
  }

  // Always loads an controller by default 'index'
  private function _loadController() {
    $file = 'controller/' . $this->_url[0] . '.php';
    if (file_exists($file)) {
      require $file;
      $this->_controller = new $this->_url[0];
      $this->_controller->loadModel($this->_url[0]);
    } else {
      $this->_error();
      die;
    }
  }

  // Loads Controller, Method, Param or arg
  private function _callController() {
    if (isset($this->_url[2])) {
      if (method_exists($this->_controller, $this->_url[1])) {
        $this->_controller->{$this->_url[1]}($this->_url[2]);
      } else {
        $this->_error();
      }
    } else if (isset($this->_url[1])) {
      if (method_exists($this->_controller, $this->_url[1])) {
        $this->_controller->{$this->_url[1]}();
      } else {
        $this->_error();
      }
    } else {
      $this->_controller->index();
    }
  }

  // Display an error if nothing exists
  private function _error() {
    echo "Error! This file does not exist yet.";
    /** We do this later:
    * require 'controllers/error.php';
    * $this->_controller = new Error();
    * $this->_controller->index(); */
    return true;
  }
}
