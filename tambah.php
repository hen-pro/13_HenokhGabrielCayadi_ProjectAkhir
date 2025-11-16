<!DOCTYPE html>
<html lang="id">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📥 ECHO: Input Data Donasi Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_futuristik.css">
    
    <style>
        
        /* CSS Khusus untuk Halaman Input */
        .input-section {
            padding: 120px 20px 80px;
            background-color: #1e1e1e; /* Warna gelap */
            min-height: 100vh;
        }
        .input-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #2a2a2a;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 224, 255, 0.15);
        }
        .input-container h2 {
            color: var(--color-accent);
            border-bottom: 2px solid var(--color-secondary);
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--color-light);
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select,
        .form-group input[type="datetime-local"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #333;
            color: var(--color-light);
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: var(--color-accent);
            outline: none;
        }
        
        /* Tombol Simpan */
        .btn-submit-data {
            background-color: var(--color-secondary);
            color: var(--color-dark);
            padding: 12px 25px;
            text-decoration: none;
            font-weight: 700;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            width: 100%;
        }
        .btn-submit-data:hover {
            background-color: #ff88bb;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <header id="main-header">
        <div class="header-container">
            <a href="index.php" class="logo">
                <span class="logo-text">E C H O</span>
            </a>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="tambah.php" class="nav-link active-link">Input Data</a></li>
                    <li><a href="data_donasi.php" class="nav-link">Show Data</a></li>
                    <li><a href="about.php" class="nav-link">About Us</a></li>
                </ul>
            </nav>

            <a href="login.php" class="btn-login">
                Log In
            </a>
        </div>
    </header>

    <main class="input-section">
        <div class="input-container">
            <h2>➕ Input Data Donasi Baru</h2>
            
            <form method="post" action="proses_tambah_donasi.php">
                
                <div class="form-group">
                    <label for="nama_donatur">Nama Donatur</label>
                    <input type="text" id="nama_donatur" name="nama_donatur" placeholder="Contoh: Budi Santoso" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_donasi">Jumlah Donasi (Rp.)</label>
                    <input type="number" id="jumlah_donasi" name="jumlah_donasi" placeholder="Contoh: 500000" min="10000" required>
                </div>
                
                <div class="form-group">
                    <label for="kategori_id">Target Kategori</label>
                    <select id="kategori_id" name="kategori_id" required>
                        <option value="">Pilih Kategori</option>
                        <option value="1">Pendidikan Digital (ID: 1)</option>
                        <option value="2">Akses Kesehatan Primer (ID: 2)</option>
                        <option value="3">Pemulihan Lingkungan (ID: 3)</option>
                        <option value="4">Kebutuhan Mendesak (ID: 4)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_pembayaran">Cara Pembayaran</label>
                    <select id="status_pembayaran" name="status_pembayaran" required>
                        <option value="Pending">BCA Virtual Account</option>
                        <option value="Success">GOPAY</option>
                        <option value="Failed">SHOPEE PAY</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="tanggal_donasi">Waktu Transaksi (Timestamp)</label>
                    <input type="datetime-local" id="tanggal_donasi" name="tanggal_donasi" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                </div>

                <button type="submit" class="btn-submit-data">SIMPAN DATA TRANSAKSI</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 ECHO Digital Giving. | *Powered by Hope & Code*</p>
    </footer>
    
</body>
</html>