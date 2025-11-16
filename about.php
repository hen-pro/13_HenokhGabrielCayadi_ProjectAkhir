<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🤝 Tentang ECHO - Kisah, Visi, dan Dampak Nyata</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_futuristik.css">
    <style>
        /* CSS Khusus Halaman About */
        .about-section {
            padding: 120px 20px 80px;
            background-color: var(--color-dark);
            color: var(--color-light);
            text-align: center;
        }
        .about-section h2 {
            font-size: 2.8em;
            color: var(--color-secondary);
            margin-bottom: 40px;
            text-shadow: 0 0 5px rgba(255, 102, 170, 0.3);
        }
        .mission-vision {
            display: flex;
            justify-content: space-around;
            gap: 40px;
            margin: 50px 0;
            text-align: left;
        }
        .vision-box, .mission-box {
            flex: 1;
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            border-left: 5px solid var(--color-accent);
            transition: background-color 0.3s;
        }
        .vision-box:hover, .mission-box:hover {
            background-color: #2a2a2a;
        }
        .vision-box h3, .mission-box h3 {
            color: var(--color-accent);
            border-bottom: 2px dotted rgba(0, 224, 255, 0.3);
            padding-bottom: 10px;
        }

        /* Galeri Dampak Interaktif */
        .impact-gallery {
            margin-top: 60px;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }
        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
            filter: brightness(0.7);
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 102, 170, 0.7);
            color: var(--color-light);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.5s;
            padding: 15px;
            text-align: center;
        }
        .gallery-item:hover .overlay {
            opacity: 1;
        }
        .overlay h4 {
            margin-top: 0;
            color: var(--color-light);
        }

        /* Video Section */
        .video-impact-section {
            background-color: #1e1e1e;
            padding: 80px 20px;
            text-align: center;
        }
        .video-impact-section h2 {
            color: var(--color-accent);
        }
        .video-container {
            max-width: 800px;
            margin: 30px auto;
            aspect-ratio: 16 / 9; /* Rasio standar video */
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
        }
        .video-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Call to Action Akhir */
        .cta-about {
            padding: 60px 20px;
        }
        .cta-about h3 {
            font-size: 2em;
        }
    </style>
</head>
<body>

    <header id="main-header">
        <div class="header-container">
            <a href="index.php" class="logo"><span class="logo-text">E C H O</span></a>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="about.php" class="nav-link active-link">About Us</a></li>
                    <li><a href="index.php#programs" class="nav-link scroll-link">Programs</a></li>
                </ul>
            </nav>
            <a href="login.php" class="btn-login">Log In</a>
        </div>
    </header>

    <main class="about-section">
        
        <h2>Mengenal ECHO: Jembatan Kebaikan Digital 🌐</h2>
        <p style="max-width: 800px; margin: 0 auto 50px;">Kami adalah *platform* yang percaya bahwa teknologi harus menjadi *echo* dari kepedulian manusia. Didirikan pada 2024, ECHO bertujuan menciptakan ekosistem donasi paling **transparan, efisien, dan berdampak** di dunia.</p>

        <section class="mission-vision container">
            <div class="vision-box">
                <h3>✨ Visi Kami</h3>
                <p>Menjadi pemimpin global dalam filantropi digital, mewujudkan dunia di mana setiap individu memiliki kesempatan yang setara melalui donasi yang terdigitalisasi dan terlacak.</p>
                <p style="font-style: italic; color: #aaa;">"Dunia adalah algoritma kebaikan yang menunggu input dari Anda."</p>
            </div>
            
            <div class="mission-box">
                <h3>🎯 Misi Kami</h3>
                <ul>
                    <li>Menyediakan platform donasi *zero-fee* dengan transparansi *real-time*.</li>
                    <li>Mengedukasi publik tentang pentingnya filantropi yang terukur dan terarah.</li>
                    <li>Membangun jaringan mitra *non-profit* tepercaya di seluruh kategori kebutuhan.</li>
                </ul>
            </div>
        </section>

        <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1);">

        <section class="impact-gallery">
            <h2>Dampak yang Telah Kita Ciptakan 📸</h2>
            <p class="subtitle" style="color: var(--color-accent);">Geser kursor Anda di atas gambar untuk melihat kisah di baliknya.</p>
            <div class="gallery-grid container">
                
                <div class="gallery-item">
                    <img src="nigga.jpg" alt="Anak-anak belajar di sekolah yang direnovasi">
                    <div class="overlay">
                        <h4>Pendidikan Digital 💡</h4>
                        <p>Ruang kelas ini direnovasi total berkat 3.500 donatur dalam 6 bulan. Sekarang, 80 siswa memiliki akses ke perangkat tablet.</p>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="3.jpg" alt="Lansia menerima bantuan kesehatan">
                    <div class="overlay">
                        <h4>Kesehatan Lansia ❤️</h4>
                        <p>Ibu Siti (78) menerima obat jantung rutin. Program ini menjangkau 450 lansia per bulan di tiga desa terpencil.</p>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="dis.jpg" alt="Penyandang disabilitas mengikuti pelatihan">
                    <div class="overlay">
                        <h4>Mandiri Disabilitas 💪</h4>
                        <p>Pelatihan *coding* dan desain ini menghasilkan 15 lulusan yang kini bekerja lepas (freelance) dari rumah. Donasi Anda membuka potensi mereka.</p>
                    </div>
                </div>

                </div>
        </section>

        <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1);">

        <section class="video-impact-section">
            <h2>Saksikan Perubahan yang Anda Ciptakan 📽️</h2>
            <p style="max-width: 700px; margin: 0 auto 30px;">Tonton video singkat berdurasi 90 detik ini, rangkuman perjalanan setiap donasi dari klik Anda hingga senyum di wajah penerima manfaat.</p>
            <div class="video-container">
                <iframe 
                    src="https://www.youtube.com/embed/CODE_VIDEO_ANDA?rel=0&amp;autoplay=0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
            
        </section>

        <section class="cta-about container">
            <h3>Siap Menjadi Bagian dari Gelombang Kebaikan Ini?</h3>
            <a href="index.php#programs" class="btn-action scroll-link">DONASI SEKARANG &gt;&gt;</a>
        </section>

    </main>
    
    <footer>
        <p>&copy; 2025 ECHO Digital Giving. | *Powered by Hope & Code*</p>
    </footer>

    <script src="script.js"></script> </body>
</html>