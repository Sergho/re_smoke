<?php

require_once('lib/Database.php');
require_once("models/User.php");

class Router {

  private $url;
  private $request;
  private $routes;
  private $session;
  private $files;
  private $database;
  private $logged;

  public function __construct($url, $request, $session, $files) {
    $config = require_once("./config/site_config.php");
    $this->url = $url;
    $this->files = $files;
    $this->request = $request;
    $this->session = $session;
    $this->routes = require($config['routes_url']);

    $this->database = new Database();

    $this->check_session();
    
  }

  public function get_url() {
    return $this->url;
  }

  public function get_request() {
    return $this->request;
  }

  public function get_routes() {
    return $this->routes;
  }

  public function get_logged() {
    return $this->logged;
  }

  public function check_session() {
    $this->logged = false;
    if(isset($this->session['id']) && isset($this->session['password'])) {
      $id = $this->session['id'];

      $password = $this->session['password'];
      $user = User::get_user($id);

      if(!empty($user)) {
        if($user['password'] == $password) {
          $this->logged = true;
        }
      }
    }
  }

  public function route() {
    foreach($this->routes as $url => $route) {
      // Check if session reuires
      $session = false;
      if(substr($url, -1) == '!') {
        $session = true;
        $url = substr($url, 0, -1);
      }
      // Check if route url fits real url
      if(preg_match($url, $this->url) && $session == $this->logged) {
        $route = explode('.', $route);
        $controller = $route[0];
        $view = $route[1];
        
        // Create a controller
        require_once('controllers/' . $controller . '.php');
        $controller_object = new $controller();

        call_user_func(Array($controller_object, $view), $this->url, $this->request, $this->session, $this->files);

        return;
      }
    }
  }

}