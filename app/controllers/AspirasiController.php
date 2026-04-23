<?php
require_once 'app/models/AspirasiModel.php';

class AspirasiController {

    // =========================
    // FORM TAMBAH ASPIRASI
    // =========================
    public function tambah() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
            header("Location: index.php");
            exit;
        }

        $model = new AspirasiModel();
        $kategori = $model->getKategori();

        include 'app/views/siswa/TambahAspirasi.php';
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function simpan() {
        $model = new AspirasiModel();

        $model->simpan(
            $_SESSION['user']['id_user'],
            $_POST['id_kategori'],
            $_POST['judul'],
            $_POST['isi']
        );

        header("Location: index.php?controller=SiswaController&action=dashboard");
        exit;
    }

    // =========================
    // DETAIL ASPIRASI
    // =========================
    public function detail() {
        $model = new AspirasiModel();

        $id = $_GET['id'];
        $data = $model->getById($id);
        $feedback = $model->getFeedback($id);

        include 'app/views/admin/detail.php';
    }

    // =========================
    // UPDATE STATUS
    // =========================
    public function updateStatus() {
        $model = new AspirasiModel();

        $model->updateStatus($_POST['id'], $_POST['status']);

        header("Location: index.php?controller=AdminController&action=dashboard");
        exit;
    }

    // =========================
    // TAMBAH FEEDBACK
    // =========================
    public function tambahFeedback() {
        $model = new AspirasiModel();

        $model->tambahFeedback($_POST['id_aspirasi'], $_POST['pesan']);

        header("Location: index.php?controller=AspirasiController&action=detail&id=" . $_POST['id_aspirasi']);
        exit;
    }

    // =========================
    // HAPUS DATA
    // =========================
    public function hapus() {
        $model = new AspirasiModel();

        $model->delete($_GET['id']);

        header("Location: index.php?controller=AdminController&action=dashboard");
        exit;
    }
}