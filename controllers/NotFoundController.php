<?php

require_once('controllers/Controller.php');

class NotFoundController extends Controller {

  static public function index($url, $request, $session) {
    $config = require('config/site_config.php');
    $view_url = $config['host'] . '/views/NotFound';

    require('views/NotFound/index.php');
  }

}