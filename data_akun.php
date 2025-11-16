<?php
// ===============================================
// 1. KONFIGURASI DATABASE
// Ganti dengan kredensial database Anda yang sebenarnya!
// ===============================================
$dbHost = "localhost"; // Biasanya localhost
$dbUser = "root";      // Username database Anda
$dbPass = "mysql";          // Password database Anda (kosong jika XAMPP/Local)
$dbName = "data";      // Nama Database Anda
$tableName = "users";  // Nama Tabel Anda

// ===============================================
// 2. KONEKSI KE DATABASE
// ===============================================
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Cek Koneksi
if ($conn->connect_error) {
    // Jika koneksi gagal, tampilkan pesan error dan hentikan skrip
    die("Koneksi gagal: " . $conn->connect_error);
}

// ===============================================
// 3. AMBIL DATA DARI TABEL USERS
// ===============================================
$sql = "SELECT id, username, password, nama_lengkap, umur, alamat FROM " . $tableName;
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>👥 Data Akun User</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_futuristik.css"> 
    <style>
        /* CSS Khusus untuk Tabel Data Akun */
        .data-section {
            padding: 80px 20px;
            min-height: 80vh;
            background-color: var(--color-dark);
            color: var(--color-light);
            text-align: center;
        }
        
        .data-table {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #1e1e1e;
            border-radius: 12px;
            overflow: hidden; /* Penting untuk radius */
            box-shadow: 0 0 20px rgba(0, 224, 255, 0.1);
        }

        .data-table th, .data-table td {
            padding: 15px;
            border-bottom: 1px solid #333;
            text-align: left;
        }

        .data-table th {
            background-color: var(--color-accent);
            color: var(--color-dark);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .data-table tr:hover {
            background-color: #2a2a2a;
        }
        
        /* Menyembunyikan Password agar tidak terlihat di HTML */
        .password-cell {
            font-family: monospace;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>

    <section class="data-section">
        <h2>Daftar Akun Pengguna Terdaftar 🔑</h2>

        <?php
        // Cek apakah ada data yang ditemukan
        if ($result->num_rows > 0) {
            echo "<table class='data-table'>";
            echo "<thead><tr><th>ID</th><th>Username</th><th>Password</th><th>Nama Lengkap</th><th>Umur</th><th>Alamat</th></tr></thead>";
            echo "<tbody>";
            
            // Loop untuk menampilkan setiap baris data
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                // Biasanya, password tidak ditampilkan secara mentah untuk keamanan!
                echo "<td class='password-cell'>" . $row["password"] . "</td>"; 
                echo "<td>" . $row["nama_lengkap"] . "</td>";
                echo "<td>" . $row["umur"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "</tr>";
            }
            
            echo "</tbody></table>";
        } else {
            echo "<p>Tidak ada data pengguna yang ditemukan di database.</p>";
        }

        // Tutup koneksi database
        $conn->close();
        ?>

    </section>

</body>
</html>