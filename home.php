<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌟 ECHO: Donasi Masa Depan - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_futuristik.css"> 
    
    <style>
        /* ======================================================= */
        /* CSS Tambahan/Override untuk Efek Radius Bulat ala iPhone */
        /* ======================================================= */

        :root {
            /* Definisi Radius Baru */
            --radius-lg: 12px; /* Untuk Kartu dan Box Utama */
            --radius-md: 8px;  /* Untuk Tombol dan Input */

            /* Warna (Pastikan Konsisten) */
            --color-dark: #121212;
            --color-light: #f0f0f0;
            --color-accent: #00e0ff; 
            --color-secondary: #ff66aa;
        }

        /* --- HEADER & NAVIGASI --- */
        
        .header-container {
            /* Terapkan radius bulat di header jika Anda ingin kotak navigasi yang menonjol */
        }
        
        /* Tombol Login */
        .btn-login {
            /* Radius lebih besar pada tombol login */
            border-radius: var(--radius-md); 
            padding: 10px 20px;
            font-weight: 500;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        /* --- HERO SECTION --- */
        
        /* Tombol Aksi Utama */
        .btn-action {
            /* Radius bulat pada tombol utama */
            border-radius: var(--radius-md); 
            padding: 15px 30px;
            font-weight: 700;
            transition: transform 0.2s, box-shadow 0.3s;
        }
        
        /* --- PROGRAM CARDS --- */
        
        .program-card {
            /* Radius bulat besar pada Kartu Program */
            background-color: #1e1e1e;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            text-align: center;
            /* Inilah yang membuat efek bulat khas */
            border-radius: var(--radius-lg); 
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        /* Ikon di Kartu */
        .card-icon {
            /* Agar ikon juga bulat, kita buat lingkaran */
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
            font-size: 2em;
            background-color: #333;
            border-radius: 50%; /* Membuat ikon benar-benar bulat */
            margin-bottom: 15px;
            box-shadow: 0 0 10px rgba(0, 224, 255, 0.2);
        }
        
        /* Tombol Detail (di dalam kartu) */
        .btn-detail {
            /* Radius bulat pada tombol detail */
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: var(--color-secondary);
            color: var(--color-dark);
            text-decoration: none;
            border-radius: var(--radius-md); 
            font-weight: 600;
            transition: background-color 0.3s;
        }
        
        /* --- TRUST SECTION --- */

        .trust-section {
            background-color: #1e1e1e;
            /* Radius bulat pada box trust section */
            border-radius: var(--radius-lg); 
            padding: 40px;
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
            box-shadow: 0 0 15px rgba(255, 102, 170, 0.1);
        }
        
        /* Tombol Secondary */
        .btn-secondary {
            /* Radius bulat pada tombol sekunder */
            display: inline-block;
            padding: 12px 25px;
            border: 1px solid var(--color-accent);
            color: var(--color-accent);
            text-decoration: none;
            border-radius: var(--radius-md); 
            transition: background-color 0.3s;
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
                    <li><a href="index.php" class="nav-link active-link">Home</a></li>
                    <li><a href="about.php" class="nav-link">About Us</a></li>
                    <li><a href="#programs" class="nav-link scroll-link">Programs</a></li>
                    <li><a href="data_akun.php" class="nav-link">Data Akun</a></li> 
                </ul>
            </nav>

            <a href="login.php" class="btn-login">
                Log In
            </a>
        </div>
    </header>

    <section id="home" class="hero-section content-section">
        <div class="hero-content">
            <h1>Ciptakan Gelombang Kebaikan.<br> Donasi Digital, Dampak Nyata.</h1>
            <p>ECHO adalah platform donasi transparan yang menghubungkan Anda langsung dengan berbagai kategori kebutuhan vital.</p>
            <a href="#programs" class="btn-action scroll-link">Jelajahi Program</a>
        </div>
        
    </section>

    <section id="programs" class="programs-section content-section">
        <div class="section-header">
            <h2>Pilih Kategori Dampak Anda</h2>
            <p>Setiap donasi adalah *byte* harapan yang mengubah dunia.</p>
        </div>
        
        <div class="card-grid">
            <div class="program-card" data-category="education">
                <div class="card-icon">📚</div>
                <h3>Pendidikan Digital</h3>
                <p>Memfasilitasi akses *e-learning* dan perangkat untuk siswa di daerah terpencil.</p>
                <a href="tambah.php" class="btn-detail">Donasi Sekarang</a>
            </div>
            
            <div class="program-card" data-category="health">
                <div class="card-icon">⚕️</div>
                <h3>Akses Kesehatan Primer</h3>
                <p>Menyediakan layanan medis dasar dan obat-obatan bagi komunitas prasejahtera.</p>
                <a href="tambah.php" class="btn-detail">Donasi Sekarang</a>
            </div>

            <div class="program-card" data-category="environment">
                <div class="card-icon">🌳</div>
                <h3>Pemulihan Lingkungan</h3>
                <p>Mendukung proyek penanaman kembali dan pembersihan kawasan vital.</p>
                <a href="tambah.php" class="btn-detail">Donasi Sekarang</a>
            </div>
            
        </div>
    </section>

    <section id="trust" class="trust-section content-section">
        <div class="trust-content">
            <h2>100% Transparansi Data</h2>
            <p>Kami menggunakan teknologi <b>blockchain-like</b> untuk memastikan setiap rupiah donasi Anda terlacak dan terlaporkan secara *real-time*.</p>
            <a href="report.php" class="btn-secondary">Lihat Laporan Keuangan</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 ECHO Digital Giving. | *Powered by Hope & Code*</p>
    </footer>
    
    <script src="script.js"></script>
</body>
</html>