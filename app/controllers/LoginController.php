<?php
require_once 'app/models/UserModel.php';

class LoginController {

    public function index() {
        include 'app/views/Login.php';
    }

    public function proses() {
        $model = new UserModel();
        $user = $model->login($_POST['username'], $_POST['password']);

        if ($user) {
            $_SESSION['user'] = $user;

            if ($user['role'] == 'admin') {
                header("Location: Index.php?controller=AdminController&action=dashboard");
            } else {
                header("Location: Index.php?controller=SiswaController&action=dashboard");
            }
            exit;
        }

        header("Location: Index.php");
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: Index.php");
        exit;
    }
}
