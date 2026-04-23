<h2>Form Aspirasi Siswa</h2>
<link rel="stylesheet" href="public/css/style.css">

<form method="post" action="Index.php?controller=AspirasiController&action=simpan">
    <label>Kategori</label><br>
    <select name="id_kategori" required>
        <?php foreach ($kategori as $k): ?>
            <option value="<?= $k['id_kategori']; ?>">
                <?= $k['nama_kategori']; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Judul</label><br>
    <input type="text" name="judul" required><br><br>

    <label>Isi Aspirasi</label><br>
    <textarea name="isi" required></textarea><br><br>

    <button type="submit">Kirim</button>
</form>
