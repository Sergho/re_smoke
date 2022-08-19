<?php

require_once("lib/Database.php");

class Product {
  private $db;
  private $id;

  public static function get_products() {
    $db = new DataBase();
    $products = $db->query("SELECT * FROM products ORDER BY `product_name`", Array());
    return $products;
  }

  public static function get_product($id) {
    $db = new DataBase();
    $product = $db->query("SELECT * FROM products WHERE `id` = :id", Array(
      ':id' => $id
    ));
    return $product[0];
  }

  public function __construct($id) {
    $this->db = new DataBase();
    $this->id = $id;
  }

  public function get_data() {
    $product = $this->db->query("SELECT * FROM products WHERE `id` = :id", Array(
      ':id' => $this->id
    ));
    return $product[0];
  }

  public function get_id() {
    return $this->id;
  }

  public function set_id($id) {
    $this->id = $id;
  }

  public function get_name() {
    $name = $this->db->query("SELECT `product_name` FROM products WHERE `id` = :id", Array(
      ':id' => $this->id
    ));
    return $name[0]['product_name'];
  }

  public function set_name($name) {
    try {
      $callback = $this->db->query("UPDATE products SET `product_name` = :name WHERE `id` = :id", Array(
        ':name' => $name,
        ':id' => $this->id
      ));
    } catch(Exception $e) {
      return "error";
    }
    return "ok";
  }

  public function get_description() {
    $description = $this->db->query("SELECT `product_description` FROM products WHERE `id` = :id", Array(
      ':id' => $this->id
    ));
    return $description[0]['product_description'];
  }

  public function set_description($description) {
    try {
      $callback = $this->db->query("UPDATE products SET `product_description` = :description WHERE `id` = :id", Array(
        ':description' => $description,
        ':id' => $this->id
      ));
    } catch(Exception $e) {
      return "error";
    }
    return "ok";
  }

  public function get_buy_price() {
    $price = $this->db->query("SELECT `buy_price` FROM products WHERE `id` = :id", Array(
      ':id' => $this->id
    ));
    return $price[0]['buy_price'];
  }

  public function set_buy_price($price) {
    if(!is_numeric($price)) return "error";
    try {
      $callback = $this->db->query("UPDATE products SET `buy_price` = :buy_price WHERE `id` = :id", Array(
        ':buy_price' => $price,
        ':id' => $this->id
      ));
    } catch(Exception $e) {
      return "error";
    }
    return "ok";
  }

  public function get_sell_price() {
    $price = $this->db->query("SELECT `sell_price` FROM products WHERE `id` = :id", Array(
      ':id' => $this->id
    ));
    return $price[0]['buy_price'];
  }

  public function set_sell_price($price) {
    if(!is_numeric($price)) return "error";
    try {
      $callback = $this->db->query("UPDATE products SET `sell_price` = :sell_price WHERE `id` = :id", Array(
        ':sell_price' => $price,
        ':id' => $this->id
      ));
    } catch(Exception $e) {
      return "error";
    }
    return "ok";
  }

  public function get_count() {
    $price = $this->db->query("SELECT `in_stock` FROM products WHERE `id` = :id", Array(
      ':id' => $this->id
    ));
    return $price[0]['in_stock'];
  }

  public function set_count($count) {
    if(!is_numeric($count)) return "error";
    try {
      $callback = $this->db->query("UPDATE products SET `in_stock` = :in_stock WHERE `id` = :id", Array(
        ':in_stock' => $count,
        ':id' => $this->id
      ));
    } catch(Exception $e) {
      return "error";
    }
    return "ok";
  }

  public function get_image() {
    $price = $this->db->query("SELECT `product_image` FROM products WHERE `id` = :id", Array(
      ':id' => $this->id
    ));
    return $price[0]['product_image'];
  }

  public function set_image($image) {
    try {
      $callback = $this->db->query("UPDATE products SET `product_image` = :product_image WHERE `id` = :id", Array(
        ':product_image' => $image,
        ':id' => $this->id
      ));
    } catch(Exception $e) {
      return "error";
    }
    return "ok";
  }

  public static function create_product($name = "Товар", $description = "Описание товара", $buy_price = 300, $sell_price = 500, $in_stock = 5) {
    try{
      $db = new DataBase();
      $id = $db->query("INSERT INTO products (`product_name`, `product_description`, `buy_price`, `sell_price`, `in_stock`) VALUES (:name, :description, :buy_price, :sell_price, :in_stock)", Array(
        ":name" => $name,
        ":description" => $description,
        ":buy_price" => $buy_price,
        ":sell_price" => $sell_price,
        ":in_stock" => $in_stock
      ));
    } catch(Exception $e) {
      return "error";
    }
    $id = $db->query("SELECT last_insert_rowid()", Array())[0]['last_insert_rowid()'];
    return self::get_product($id);
  }

  public static function delete_product($id) {
    try{
      $db = new DataBase();
      $callback = $db->query("DELETE FROM products WHERE `id` = :id", Array(
        ':id' => $id
      ));
    } catch(Exception $e) {
      return "error";
    }
    return "ok";
  }

}