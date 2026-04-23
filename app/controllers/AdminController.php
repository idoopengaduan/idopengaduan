<?php
require_once 'app/models/AspirasiModel.php';

class AdminController {

    private $model;

    public function __construct() {
        $this->model = new AspirasiModel();
    }

    public function dashboard() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: Index.php");
            exit;
        }

        $tanggal  = $_GET['tanggal']  ?? '';
        $kategori = $_GET['kategori'] ?? '';
        $siswa    = $_GET['siswa']    ?? '';

        if ($tanggal || $kategori || $siswa) {
            $aspirasi = $this->model->filter($tanggal, $kategori, $siswa);
        } else {
            $aspirasi = $this->model->getAll();
        }

        $kategoriList = $this->model->getKategori();
        $siswaList    = $this->model->getSiswa();

        include 'app/views/admin/Dashboard.php';
    }

    public function detail() {
        $data = $this->model->getById($_GET['id']);
        $feedback = $this->model->getFeedback($_GET['id']);

        include 'app/views/admin/DetailAspirasi.php';
    }

    public function proses() {
        $this->model->updateStatus($_POST['id_aspirasi'], $_POST['status']);
        $this->model->tambahFeedback($_POST['id_aspirasi'], $_POST['pesan']);

        header("Location: Index.php?controller=AdminController&action=dashboard");
        exit;
    }

    public function edit() {
        $id = $_GET['id'];
        $data = $this->model->getById($id);
        $kategoriList = $this->model->getKategori();

        require 'app/views/admin/edit.php';
    }

    public function update() {
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $id_kategori = $_POST['id_kategori'];
        $status = $_POST['status'];

        $this->model->update($id, $judul, $isi, $id_kategori);
        $this->model->updateStatus($id, $status);

        header("Location: index.php?controller=AdminController&action=dashboard");
    }

    public function hapus() {
        $id = $_GET['id'];

        $this->model->delete($id);

        header("Location: index.php?controller=AdminController&action=dashboard");
    }
}