<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Pengaduan Sekolah</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <h2> Selamat Datang</h2>
        <p>Silakan login untuk melanjutkan</p>

        <form method="post" action="Index.php?controller=LoginController&action=proses">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>

</body>
</html>
