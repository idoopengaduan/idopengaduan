<h2>Histori Aspirasi</h2>
<link rel="stylesheet" href="public/css/style.css">

<table border="1" cellpadding="5">
<tr>
    <th>Tanggal</th>
    <th>Kategori</th>
    <th>Judul</th>
    <th>Status</th>
    <th>Umpan Balik</th>
</tr>

<?php foreach ($histori as $h): ?>
<tr>
    <td><?= $h['tanggal']; ?></td>
    <td><?= $h['nama_kategori']; ?></td>
    <td><?= $h['judul']; ?></td>
    <td><?= $h['status']; ?></td>
    <td>
        <?php
        $fb = (new AspirasiModel())->getFeedback($h['id_aspirasi']);
        echo $fb ? $fb['pesan'] : '-';
        ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

<br>
<a href="Index.php?controller=SiswaController&action=dashboard">Kembali</a>
