<?php

class Database {
  private $connection;
  private $db_url;

  public function __construct() {
    $config = require('./config/site_config.php');
    $this->db_url = $config['db_url'];
    $this->connection = new PDO('sqlite:' . $this->db_url);
  }

  public function get_connection() {
    return $this->connection;
  }

  public function query($query, $args) {
    $callback = $this->connection->prepare($query);
    $callback->execute($args);
    return $callback->fetchAll(PDO::FETCH_ASSOC);
  }

}