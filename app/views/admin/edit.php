<!DOCTYPE html>
<html>
<head>
    <title>Edit Aspirasi</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 420px;
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.5s ease;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            color: #555;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: 0.3s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 5px rgba(102,126,234,0.5);
        }

        textarea {
            height: 90px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

<div class="card">
    <h2>Edit Aspirasi</h2>

    <form method="post" action="index.php?controller=AdminController&action=update">
        
        <input type="hidden" name="id" value="<?= $data['id_aspirasi']; ?>">

        <label>Judul</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" required>

        <label>Isi</label>
        <textarea name="isi" required><?= htmlspecialchars($data['isi']); ?></textarea>

        <label>Kategori</label>
        <select name="id_kategori">
            <?php foreach ($kategoriList as $k): ?>
                <option value="<?= $k['id_kategori']; ?>"
                    <?= ($data['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Status</label>
        <select name="status">
            <option value="proses" <?= ($data['status'] == 'proses') ? 'selected' : ''; ?>>Proses</option>
            <option value="selesai" <?= ($data['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
        </select>

        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>