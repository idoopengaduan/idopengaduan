<?php
require_once 'Koneksi.php';

class UserModel extends Koneksi {

    public function login($username, $password) {
        $username = $this->conn->real_escape_string($username);
        $password = md5($password);

        $query = "SELECT * FROM users 
                  WHERE username='$username' 
                  AND password='$password'";

        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }
}
