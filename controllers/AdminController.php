<?php

require_once('controllers/Controller.php');
require_once('models/User.php');
require_once('models/Product.php');

class AdminController extends Controller {

  public function index($url, $request, $session, $files) {
    $config = require_once("config/site_config.php");
    header("Location: " . $config['host'] . "/admin/products");
  }

  public function products($url, $request, $session, $files) {
    $config = require('config/site_config.php');
    $view_url = $config['host'] . '/views/Admin';
    $products = Product::get_products();

    require("views/Admin/products.php");
  }

  public function orders($url, $request, $session, $files) {
    $config = require('config/site_config.php');
    $view_url = $config['host'] . '/views/Admin';
    require("views/Admin/orders.php");
  }

  public function users($url, $request, $session, $files) {
    $config = require('config/site_config.php');
    $view_url = $config['host'] . '/views/Admin';
    require("views/Admin/users.php");
  }

  public function login($url, $request, $session, $files) {
    $config = require('config/site_config.php');
    $view_url = $config['host'] . '/views/Admin';
    require("views/Admin/login.php");
  }

  public function auth($url, $request, $session, $files) {
    $errors = Array();
    $user = "";
    if(empty($errors) && isset($request['name']) && isset($request['password'])) {
      $name = $request['name'];
      $password = $request['password'];
      if($name == "") $errors[] = 'empty_name';
      if($password == "") $errors[] = 'empty_password';
      if(empty($errors)) {
        $user = User::find_user($name, $password);
        if(empty($user)) $errors[] = 'wrong_password';
      }
    } else {
      $errors[] = 'fields_not_found';
    }
    if($errors) echo implode("|", $errors);
    else {
      $_SESSION['id'] = $user['id'];
      $_SESSION['password'] = $user['password'];
      echo "ok";
    }
  }

  public function login_redirect($url, $request, $session, $files) {
    $config = require_once("config/site_config.php");
    header("Location: " . $config['host'] . "/admin/login");
  }

  public function get_product_info($url, $request, $session, $files) {
    if(!isset($request['id'])){
      echo "error1";
      return;
    }
    $id = $request['id'];
    $product = Product::get_product($id);
    echo json_encode($product);
  }

  public function product_change($url, $request, $session, $files) {
    if(!isset($request['id']) || !isset($request['field']) || !isset($request['value'])) {
      print_r($request);
      echo "error";
      return;
    }
    $id = $request['id'];
    $field = $request['field'];
    $value = $request['value'];

    $product = new Product($id);
    if($field == 'name') echo $product->set_name($value);
    if($field == 'description') echo $product->set_description($value);
    if($field == 'buy_price') echo $product->set_buy_price($value);
    if($field == 'sell_price') echo $product->set_sell_price($value);
    if($field == 'count') echo $product->set_count($value);
    if($field == 'image') echo $product->set_image($value);
  }

  public function delete_image($url, $request, $session, $files) {
    $config = require('config/site_config.php');
    $link = '.' . explode($config['host'], $request['old'])[1];
    if($link != "./media/no-image.svg") {
      unlink($link);
    }
    echo "ok";
  }

  public function create_image($url, $request, $session, $files) {
    if(!isset($files['file'])) {
      echo "error";
      return;
    }
    $config = require('config/site_config.php');
    $filename = "./media/" . rand() . "." . explode(".", $files['file']['name'])[1];
    file_put_contents($filename, '');
    move_uploaded_file($files['file']['tmp_name'], $filename);
    echo substr($filename, 1);
    return;
  }

  public function create_product($url, $request, $session, $files) {
    $product = Product::create_product();
    echo json_encode($product);
  }

  public function delete_product($url, $request, $session, $files) {
    if(!isset($request['id'])){
      echo "error";
      return;
    }
    $id = $request['id'];
    Product::delete_product($id);
    echo "ok";
  }

}