<?php
// Mengaktifkan laporan error PHP untuk debugging (Hapus baris ini setelah berhasil)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pastikan file koneksi.php sudah terhubung dengan $koneksi
include "koneksi.php"; 

// 1. PROSES DATA DARI FORMULIR (POST REQUEST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- Ambil dan Validasi Data Input ---
    
    // Nama Donatur (VARCHAR)
    $nama_donatur = trim($_POST['nama_donatur']);
    if (empty($nama_donatur)) {
        $nama_donatur = "Anonim";
    }
    
    // Jumlah Donasi (DECIMAL) - Validasi sebagai FLOAT
    $jumlah_donasi = filter_var($_POST['jumlah_donasi'], FILTER_VALIDATE_FLOAT);
    if ($jumlah_donasi === false || $jumlah_donasi < 10000) {
        header("Location: tambah.php?error=jumlah_invalid");
        exit();
    }
    
    // Kategori ID (INTEGER) - Validasi sebagai INT
    $kategori_id = filter_var($_POST['kategori_id'], FILTER_VALIDATE_INT);
    if ($kategori_id === false || $kategori_id < 1) {
        header("Location: tambah.php?error=kategori_invalid");
        exit();
    }

    // Status Pembayaran (ENUM/VARCHAR)
    $status_pembayaran = $_POST['status_pembayaran'];
    $allowed_statuses = ['BCA Virtual Account'];
    if (!in_array($status_pembayaran, $allowed_statuses)) {
        $status_pembayaran = 'BCA Virtual Account'; // Default jika input tidak valid
    }

    // Waktu Transaksi (TIMESTAMP/DATETIME)
    $tanggal_donasi = $_POST['tanggal_donasi'];
    // Format dari datetime-local (YYYY-MM-DDTHH:MM) harus diubah ke format MySQL (YYYY-MM-DD HH:MM:SS)
    $tanggal_donasi_formatted = str_replace('T', ' ', $tanggal_donasi) . ':00';
    
    
    // 2. QUERY INSERT DATA MENGGUNAKAN MYSQLI PREPARED STATEMENTS
    $sql = "INSERT INTO donasi (nama_donatur, jumlah_donasi, id_kategori, status_pembayaran, tanggal_donasi) 
            VALUES (?, ?, ?, ?, ?)";
            
    // Siapkan statement
    $stmt = mysqli_prepare($koneksi, $sql);
    
    if ($stmt === false) {
        // Ini terjadi jika query SQL salah
        die("Error menyiapkan query: " . mysqli_error($koneksi));
    }


    if (mysqli_stmt_bind_param($stmt, "sdiss", 
        $nama_donatur, 
        $jumlah_donasi, 
        $kategori_id, 
        $status_pembayaran, 
        $tanggal_donasi_formatted)
    ) {
        
        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            // 3. Sukses: Redirect ke halaman "Show Data"
            mysqli_stmt_close($stmt);
            header("Location: data_donasi.php?status=success");
            exit();
        } else {
            // 4. Gagal Eksekusi: Tampilkan error (misalnya karena Foreign Key)
            mysqli_stmt_close($stmt);
            die("Error saat eksekusi data: " . mysqli_stmt_error($stmt));
        }
        
    } else {
        // Gagal bind parameter
        mysqli_stmt_close($stmt);
        die("Error bind parameter.");
    }

} else {
    // Jika diakses tanpa metode POST, kembalikan ke halaman input
    header("Location: tambah.php");
    exit();
}
?>