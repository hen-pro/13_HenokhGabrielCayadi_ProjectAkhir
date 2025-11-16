<?php
session_start();
// Pastikan file koneksi.php sudah terhubung dengan $koneksi
include "koneksi.php"; 

if (isset($_POST['login'])) {
    
    // 1. Ambil input dan bersihkan (sanitize)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 2. Query dengan Prepared Statements (Keamanan: Mencegah SQL Injection)
    $query = "SELECT username, password, nama_lengkap FROM users WHERE username = ?";
    
    // Siapkan statement
    $stmt = $koneksi->prepare($query);
    
    // Bind parameter (s = string)
    $stmt->bind_param("s", $username);
    
    // Jalankan statement
    $stmt->execute();
    
    // Ambil hasil
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user) {
        // 3. Verifikasi Password menggunakan password_verify (Wajib: Karena Anda menggunakan password_verify di kode lama)
        if (password_verify($password, $user['password'])) {
            // Login Berhasil
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            
            // Redirect ke halaman home.php setelah login
            header("Location: home.php");
            exit(); 

        } else {
            // Password salah
            $error_message = "Username atau password salah!";
        }
    } else {
        // User tidak ditemukan
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔒 ECHO: Akses Portal Kebaikan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_futuristik.css"> 
    
    <style>
        /* Menggunakan warna aksen futuristik dari style_futuristik.css */
        :root {
            --color-dark: #121212;
            --color-light: #f0f0f0;
            --color-accent: #00e0ff; /* Sian Neon */
            --color-secondary: #ff66aa; /* Magenta */
        }
        
        .login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--color-dark);
            padding: 20px;
        }

        .login-card {
            background-color: #1e1e1e; 
            padding: 50px 40px;
            border-radius: 12px;
            /* Efek glow neon */
            box-shadow: 0 0 30px rgba(0, 224, 255, 0.2); 
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid rgba(0, 224, 255, 0.1);
        }

        .login-card h2 {
            font-size: 2.2em;
            color: var(--color-accent);
            margin-bottom: 5px;
            text-shadow: 0 0 10px rgba(0, 224, 255, 0.3);
        }
        
        .login-card .subtitle {
            color: #ccc;
            margin-bottom: 30px;
            display: block;
        }
        
        /* Area Pesan Error */
        .error-message {
            background-color: #ff66aa33; /* Magenta transparan */
            color: var(--color-secondary);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid var(--color-secondary);
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 15px 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            background-color: #333;
            color: var(--color-light);
            font-size: 1em;
            transition: box-shadow 0.3s, background-color 0.3s;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
        }
        
        /* INTERAKTIF: Input Glow pada Fokus */
        .form-group input:focus {
            outline: none;
            box-shadow: 0 0 15px rgba(0, 224, 255, 0.5); 
            background-color: #383838;
        }

        /* Tombol Login */
        .btn-login-submit {
            background-color: var(--color-secondary);
            color: var(--color-dark);
            padding: 15px;
            font-weight: 700;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 1.1em;
            transition: background-color 0.3s, transform 0.2s;
        }

        /* INTERAKTIF: Tombol Bergetar/Mengecil saat ditekan */
        .btn-login-submit:hover {
            background-color: #ff88bb;
        }
        .btn-login-submit:active {
            transform: scale(0.98);
        }
        
        .register-link {
            margin-top: 25px;
            font-size: 0.9em;
            color: #ccc;
        }
        .register-link a {
            color: var(--color-accent);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .register-link a:hover {
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


    <div class="login-page">
        <div class="login-card">
            <h2>Akses Portal ECHO</h2>
            <span class="subtitle">Masukkan kredensial Anda untuk melanjutkan.</span>

            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                
                <button type="submit" name="login" class="btn-login-submit">MASUK KE DASHBOARD</button>
            </form>

            <div class="register-link">
                Belum punya akun? <a href="register.php">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>