<?php

include "koneksi.php"; 


$query = "SELECT 
            d.id_donasi, 
            d.nama_donatur, 
            d.jumlah_donasi, 
            d.tanggal_donasi, 
            d.status_pembayaran,
            k.nama_kategori
          FROM donasi d
          JOIN kategori k ON d.id_kategori = k.id_kategori
          ORDER BY d.tanggal_donasi DESC"; 


$stmt = mysqli_prepare($koneksi, $query);

if ($stmt === false) {
    die("Error menyiapkan query: " . mysqli_error($koneksi));
}

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    $data_donasi = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    die("Error mengeksekusi query: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📊 ECHO: Data Transaksi Donasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_futuristik.css">
    
    <style>
        :root {
            --color-dark: #121212;
            --color-light: #f0f0f0;
            --color-accent: #00e0ff; 
            --color-secondary: #ff66aa; 
        }

        .data-section {
            padding: 120px 20px 80px;
            background-color: var(--color-dark);
            min-height: 100vh;
        }
        
        .data-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1e1e1e; 
            box-shadow: 0 0 20px rgba(0, 224, 255, 0.1); 
            border-radius: 8px;
            overflow: hidden; 
            margin-top: 30px;
        }

        .data-table th {
            background-color: var(--color-accent);
            color: var(--color-dark);
            padding: 15px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #3c3c3c;
            color: var(--color-light);
            transition: background-color 0.3s;
        }

        .data-table tr:hover {
            background-color: #2a2a2a; 
            cursor: pointer;
        }
        
        .status-success {
            color: #00e0ff;
            font-weight: 700;
        }
        .status-pending {
            color: #ffcc00; 
            font-weight: 700;
        }
        .status-failed {
            color: #f44336; 
            font-weight: 700;
        }
        
        /* Style untuk tombol Opsi */
        .btn-action {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9em;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .btn-update {
            background-color: var(--color-accent);
            color: var(--color-dark);
        }
        .btn-update:hover {
            background-color: #00ffff;
        }
        .btn-delete {
            background-color: var(--color-secondary);
            color: var(--color-dark);
        }
        .btn-delete:hover {
            background-color: #ff88c2;
        }
    </style>
</head>
<body>

    <header id="main-header">
        <div class="header-container">
            <a href="index.php" class="logo"><span class="logo-text">E C H O</span></a>
            <nav class="main-nav">
                <ul>
                    <li><a href="tambah.php" class="nav-link">Input Data</a></li>
                    <li><a href="data_donasi.php" class="nav-link active-link">Show Data</a></li>
                    <li><a href="about.php" class="nav-link">About Us</a></li>
                </ul>
            </nav>
            <a href="login.php" class="btn-login">Log In</a>
        </div>
    </header>

    <main class="data-section">
        <div class="data-container">
            <h2>Laporan Transaksi Donasi Digital</h2>
            <span class="subtitle">Data diambil Real-time dari sistem ECHO. Total: <?php echo count($data_donasi); ?> Transaksi</span>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>Nama Donatur</th>
                        <th>Jumlah Donasi</th>
                        <th>Target Kategori</th>
                        <th>Waktu Donasi</th>
                        <th>Metode Bayar</th>
                        <th>Opsi</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data_donasi)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: var(--color-secondary);">
                                Belum ada data transaksi donasi. Silakan input data.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data_donasi as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id_donasi']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_donatur']); ?></td>
                                <td>Rp <?php echo number_format($row['jumlah_donasi'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_kategori']); ?></td>
                                <td><?php echo date('d M Y, H:i:s', strtotime($row['tanggal_donasi'])); ?></td>
                                <td>
                                    <?php 
                                        $status = htmlspecialchars($row['status_pembayaran']);
                                        $class = '';
                                        if ($status == 'BCA Virtual Account') $class = 'status-success';
                                        else if ($status == '') $class = 'status-pending';
                                        else $class = 'status-failed';
                                    ?>
                                    <span class="<?php echo $class; ?>"><?php echo $status; ?></span>
                                </td>
                                <td>
                                    <a href="update.php?id=<?php echo $row['id_donasi']; ?>" class="btn-action btn-update">
                                        Update
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id_donasi']; ?>" class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 ECHO Digital Giving. | *Powered by Hope & Code*</p>
    </footer>
</body>
</html>