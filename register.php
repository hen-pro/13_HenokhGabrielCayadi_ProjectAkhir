<?php
// Asumsi 'koneksi.php' berisi kode koneksi ke database Anda ($koneksi)
include "koneksi.php";

if (isset($_POST['register'])) {
    
    // 1. Ambil dan bersihkan input dari semua kolom
    $username = $_POST['username'];
    // Password di-hash (Wajib untuk keamanan)
    $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama = $_POST['nama_lengkap'];
    
    // Tambahan input baru: Umur dan Alamat
    // Umur menggunakan integer (i)
    $umur = (int)$_POST['umur']; 
    $alamat = $_POST['alamat'];

    // 2. Query dengan Prepared Statements
    // Memasukkan semua kolom: username, password, nama_lengkap, umur, alamat
    $query = "INSERT INTO users (username, password, nama_lengkap, umur, alamat) VALUES (?, ?, ?, ?, ?)";
    
    // Siapkan statement
    $stmt = $koneksi->prepare($query);
    
    // Bind parameter (s = string, s = string, s = string, i = integer, s = string)
    // Urutan harus SANGAT SESUAI: (username, password_hashed, nama, umur, alamat)
    $stmt->bind_param("sssis", $username, $password_hashed, $nama, $umur, $alamat);
    
    // Jalankan statement
    $result = $stmt->execute();
    
    if ($result) {
        // Registrasi berhasil: Redirect ke halaman login
        // *Ganti alert() dengan notifikasi kustom di lingkungan produksi*
        echo "<script>alert('Registrasi berhasil! Silakan Login.'); window.location='login.php';</script>";
        exit();
    } else {
        // Gagal mendaftar
        // Anda bisa menampilkan error yang lebih spesifik jika di lingkungan development: echo "Gagal mendaftar: " . $stmt->error;
        echo "<script>alert('Gagal mendaftar! Username mungkin sudah terdaftar atau terjadi kesalahan sistem.');</script>";
    }
    
    // Tutup statement
    $stmt->close();
}
// Pastikan koneksi ditutup di file 'koneksi.php' setelah semua operasi selesai, 
// atau biarkan di sini jika 'koneksi.php' hanya membuka koneksi.
// $koneksi->close(); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📝 ECHO: Daftar Akun Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_futuristik.css"> 
    
    <style>
        /* Menggunakan CSS yang sama dari halaman login untuk konsistensi */
        :root {
            --color-dark: #121212;
            --color-light: #f0f0f0;
            --color-accent: #00e0ff; /* Sian Neon */
            --color-secondary: #ff66aa; /* Magenta */
        }
        
        .register-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--color-dark);
            padding: 20px;
        }

        .register-card {
            background-color: #1e1e1e; 
            padding: 50px 40px;
            border-radius: 12px;
            /* Efek glow neon */
            box-shadow: 0 0 30px rgba(255, 102, 170, 0.2); /* Menggunakan glow magenta untuk Register */
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid rgba(255, 102, 170, 0.1);
        }

        .register-card h2 {
            font-size: 2.2em;
            color: var(--color-secondary); /* Warna magenta untuk judul register */
            margin-bottom: 5px;
            text-shadow: 0 0 10px rgba(255, 102, 170, 0.3);
        }
        
        .register-card .subtitle {
            color: #ccc;
            margin-bottom: 30px;
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            color: var(--color-light);
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 0.9em;
        }

        .form-group input {
            width: 100%;
            padding: 15px 12px;
            border: none;
            border-radius: 8px;
            background-color: #333;
            color: var(--color-light);
            font-size: 1em;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
            transition: box-shadow 0.3s, background-color 0.3s;
        }
        
        /* INTERAKTIF: Input Glow pada Fokus (Menggunakan aksen Sian Neon) */
        .form-group input:focus {
            outline: none;
            box-shadow: 0 0 15px rgba(0, 224, 255, 0.5); 
            background-color: #383838;
        }

        /* Tombol Daftar */
        .btn-register-submit {
            background-color: var(--color-accent); /* Menggunakan Sian Neon untuk tombol primer */
            color: var(--color-dark);
            padding: 15px;
            font-weight: 700;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 1.1em;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        /* INTERAKTIF: Tombol Bergetar/Mengecil saat ditekan */
        .btn-register-submit:hover {
            background-color: #00ffff;
        }
        .btn-register-submit:active {
            transform: scale(0.98);
        }
        
        .login-link {
            margin-top: 25px;
            font-size: 0.9em;
            color: #ccc;
        }
        .login-link a {
            color: var(--color-secondary); /* Magenta untuk link Login */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .login-link a:hover {
            color: #fff;
        }

        /* Navigasi Header untuk kembali ke Home */
        .btn-back-home {
            background-color: transparent;
            color: var(--color-light);
            border: 1px solid var(--color-accent);
            padding: 8px 15px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-back-home:hover {
            background-color: var(--color-accent);
            color: var(--color-dark);
        }
    </style>
</head>
<body>

    <header style="position: absolute; top: 0; background: transparent; box-shadow: none;">
        <div class="header-container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
            <a href="index.php" class="logo"><span class="logo-text">E C H O</span></a>
            <a href="index.php" class="btn-back-home">
                &lt; Kembali ke Home
            </a>
        </div>
    </header>


    <div class="register-page">
        <div class="register-card">
            <h2>Buat Akun ECHO</h2>
            <span class="subtitle">Bergabunglah dan mulai ciptakan dampak positif.</span>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username unik Anda" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                </div>
                
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label for="umur">Umur</label>
                    <!-- Input number lebih baik untuk umur -->
                    <input type="number" name="umur" placeholder="Masukan Umur Anda" required min="1">
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" placeholder="Alamat Anda" required>
                </div>
                
                <button type="submit" name="register" class="btn-register-submit">DAFTAR SEKARANG</button>
            </form>

            <div class="login-link">
                Sudah Punya Akun? <a href="login.php">Login di sini</a>
            </div>
        </div>
    </div>
</body>
</html>