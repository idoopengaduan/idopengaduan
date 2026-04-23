<?php
require_once __DIR__ . '/Koneksi.php';

class AspirasiModel extends Koneksi {

    public function getKategori() {
        $data = [];
        $result = $this->conn->query("SELECT * FROM kategori");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function simpan($id_user, $id_kategori, $judul, $isi) {
        $stmt = $this->conn->prepare(
            "INSERT INTO aspirasi (id_user, id_kategori, judul, isi) VALUES (?,?,?,?)"
        );
        $stmt->bind_param("iiss", $id_user, $id_kategori, $judul, $isi);
        return $stmt->execute();
    }

    public function getByUser($id_user) {
        $data = [];
        $stmt = $this->conn->prepare(
            "SELECT a.*, k.nama_kategori 
             FROM aspirasi a 
             JOIN kategori k ON a.id_kategori = k.id_kategori
             WHERE a.id_user = ?
             ORDER BY a.tanggal DESC"
        );
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAll() {
        $data = [];
        $query = "SELECT a.*, u.nama, k.nama_kategori
                  FROM aspirasi a
                  JOIN users u ON a.id_user = u.id_user
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  ORDER BY a.tanggal DESC";
        $result = $this->conn->query($query);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM aspirasi WHERE id_aspirasi = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare(
            "UPDATE aspirasi SET status=? WHERE id_aspirasi=?"
        );
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    public function tambahFeedback($id_aspirasi, $pesan) {
        $stmt = $this->conn->prepare(
            "INSERT INTO umpan_balik (id_aspirasi, pesan) VALUES (?,?)"
        );
        $stmt->bind_param("is", $id_aspirasi, $pesan);
        return $stmt->execute();
    }

    public function getFeedback($id_aspirasi) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM umpan_balik WHERE id_aspirasi = ?"
        );
        $stmt->bind_param("i", $id_aspirasi);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getHistoriSiswa($id_user) {
        $data = [];
        $stmt = $this->conn->prepare(
            "SELECT a.*, k.nama_kategori
             FROM aspirasi a
             JOIN kategori k ON a.id_kategori = k.id_kategori
             WHERE a.id_user = ?
             ORDER BY a.tanggal DESC"
        );
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function filter($tanggal, $kategori, $siswa) {
        $where = [];

        if ($tanggal != '') {
            $where[] = "DATE(a.tanggal) = '$tanggal'";
        }
        if ($kategori != '') {
            $where[] = "a.id_kategori = '$kategori'";
        }
        if ($siswa != '') {
            $where[] = "a.id_user = '$siswa'";
        }

        $whereSql = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

        $query = "SELECT a.*, u.nama, k.nama_kategori
                  FROM aspirasi a
                  JOIN users u ON a.id_user = u.id_user
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  $whereSql
                  ORDER BY a.tanggal DESC";

        $data = [];
        $result = $this->conn->query($query);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getSiswa() {
        $data = [];
        $result = $this->conn->query(
            "SELECT * FROM users WHERE role='siswa'"
        );
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // ===============================
    // 🔥 TAMBAHAN FITUR EDIT & HAPUS
    // ===============================

    public function update($id, $judul, $isi, $id_kategori) {
        $stmt = $this->conn->prepare(
            "UPDATE aspirasi SET judul=?, isi=?, id_kategori=? WHERE id_aspirasi=?"
        );
        $stmt->bind_param("ssii", $judul, $isi, $id_kategori, $id);
        return $stmt->execute();
    }

    public function delete($id) {

    // hapus dulu feedback
    $stmt1 = $this->conn->prepare(
        "DELETE FROM umpan_balik WHERE id_aspirasi=?"
    );
    $stmt1->bind_param("i", $id);
    $stmt1->execute();

    // baru hapus aspirasi
    $stmt2 = $this->conn->prepare(
        "DELETE FROM aspirasi WHERE id_aspirasi=?"
    );
    $stmt2->bind_param("i", $id);
    return $stmt2->execute();
}
}