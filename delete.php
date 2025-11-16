<?php
// Pastikan file koneksi.php sudah terhubung dengan $koneksi
include "koneksi.php"; 

if (isset($_GET['id'])) {
    // 1. Ambil dan Validasi ID dari URL
    $id_donasi = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    if ($id_donasi === false || $id_donasi < 1) {
        // Jika ID tidak valid, kembalikan ke halaman data
        header("Location: data_donasi.php?status=delete_invalid_id");
        exit();
    }

    // 2. Query DELETE
    $query_delete = "DELETE FROM donasi WHERE id_donasi = ?";
                    
    $stmt_delete = mysqli_prepare($koneksi, $query_delete);
    
    if ($stmt_delete === false) {
        die("Error menyiapkan query DELETE: " . mysqli_error($koneksi));
    }
    
    // Bind Parameter: i (integer)
    mysqli_stmt_bind_param($stmt_delete, "i", $id_donasi);

    // 3. Eksekusi dan Redirect
    if (mysqli_stmt_execute($stmt_delete)) {
        mysqli_stmt_close($stmt_delete);
        // Hapus berhasil, redirect dengan pesan sukses
        header("Location: data_donasi.php?status=deleted");
        exit();
    } else {
        mysqli_stmt_close($stmt_delete);
        // Gagal menghapus (misalnya karena Foreign Key Constraint)
        header("Location: data_donasi.php?status=delete_failed");
        exit();
    }

} else {
    // Jika diakses tanpa ID
    header("Location: data_donasi.php");
    exit();
}
?>