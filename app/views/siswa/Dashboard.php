<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2> Dashboard Siswa</h2>
        <div class="user-info">
            <?= $_SESSION['user']['nama']; ?>
        </div>
    </div>

    <div class="card">
        <p>👋 Halo, <b><?= $_SESSION['user']['nama']; ?></b><br>
        Silakan sampaikan aspirasi atau cek histori laporanmu.</p>
    </div>

    <div class="card action-card">
        <a class="btn btn-primary" href="Index.php?controller=AspirasiController&action=tambah">
            ➕ Tambah Aspirasi
        </a>

        <a class="btn btn-secondary" href="Index.php?controller=SiswaController&action=histori">
            📜 Histori Aspirasi
        </a>
    </div>

    <div class="footer">
        <a class="btn btn-danger" href="Index.php?controller=LoginController&action=logout">
            🚪 Logout
        </a>
    </div>
</div>

</body>
</html>
