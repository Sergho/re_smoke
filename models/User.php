<?php

require_once("lib/Database.php");

class User {

    public static function get_user($id) {
        $db = new Database();
        $user = $db->query("SELECT * FROM users WHERE `id` = :id", Array(':id' => $id));
        return $user[0];
    }

    public static function find_user($username, $password) {
        $password = self::password_encode($password);
        $db = new Database();
        $user = $db->query("SELECT * FROM users WHERE `username` = :username AND `password` = :password", Array(
            ':username' => $username,
            ':password' => $password
        ));
        return $user[0];
    }

    private static function password_encode($password) {
        return hash('sha256', '_' . $password . '_');
    }
}