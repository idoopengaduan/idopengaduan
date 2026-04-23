<h3>Detail Aspirasi</h3>
<link rel="stylesheet" href="public/css/style.css">

<p><b>Judul:</b> <?= $data['judul']; ?></p>
<p><b>Isi:</b> <?= $data['isi']; ?></p>
<p><b>Status:</b> <?= $data['status']; ?></p>

<?php if ($feedback): ?>
    <p><b>Umpan Balik:</b> <?= $feedback['pesan']; ?></p>
<?php endif; ?>

<hr>

<form method="post" action="Index.php?controller=AdminController&action=proses">
    <input type="hidden" name="id_aspirasi" value="<?= $data['id_aspirasi']; ?>">

    <label>Status</label><br>
    <select name="status">
        <option value="baru">Baru</option>
        <option value="diproses">Diproses</option>
        <option value="selesai">Selesai</option>
    </select><br><br>

    <label>Umpan Balik</label><br>
    <textarea name="pesan" required></textarea><br><br>

    <button type="submit">Simpan</button>
</form>
