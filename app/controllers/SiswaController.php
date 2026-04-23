<?php
class SiswaController {

    public function dashboard() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
            header("Location: Index.php");
            exit;
        }

        include 'app/views/siswa/Dashboard.php';
    }

    public function histori() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
        header("Location: Index.php");
        exit;
    }

    require_once 'app/models/AspirasiModel.php';
    $model = new AspirasiModel();
    $histori = $model->getHistoriSiswa($_SESSION['user']['id_user']);

    include 'app/views/siswa/HistoriAspirasi.php';
}

}
