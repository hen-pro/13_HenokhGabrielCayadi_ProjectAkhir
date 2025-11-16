<?php
// Pastikan file koneksi.php sudah terhubung dengan $koneksi
include "koneksi.php"; 

// ==========================================================
// BAGIAN 1: Mengambil Data Lama (saat pertama kali diakses)
// ==========================================================
if (isset($_GET['id'])) {
    $id_donasi = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    if ($id_donasi === false || $id_donasi < 1) {
        die("ID Donasi tidak valid.");
    }

    // Query untuk mengambil data donasi spesifik dan nama kategorinya
    $query_select = "SELECT 
                        d.id_donasi, 
                        d.nama_donatur, 
                        d.jumlah_donasi, 
                        d.tanggal_donasi, 
                        d.status_pembayaran,
                        d.id_kategori 
                     FROM donasi d
                     WHERE d.id_donasi = ?";
    
    $stmt_select = mysqli_prepare($koneksi, $query_select);
    mysqli_stmt_bind_param($stmt_select, "i", $id_donasi);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);
    $data_lama = mysqli_fetch_assoc($result_select);
    mysqli_stmt_close($stmt_select);

    if (!$data_lama) {
        die("Data donasi tidak ditemukan.");
    }
    
} else if (isset($_POST['id_donasi'])) {
    
    // ==========================================================
    // BAGIAN 2: Memproses Form UPDATE (setelah tombol Simpan ditekan)
    // ==========================================================
    
    // 1. Ambil dan Validasi Data POST
    $id_donasi = filter_var($_POST['id_donasi'], FILTER_VALIDATE_INT);
    $nama_donatur = trim($_POST['nama_donatur']);
    $jumlah_donasi = filter_var($_POST['jumlah_donasi'], FILTER_VALIDATE_FLOAT);
    $kategori_id = filter_var($_POST['kategori_id'], FILTER_VALIDATE_INT);
    $status_pembayaran = $_POST['status_pembayaran'];
    $tanggal_donasi = $_POST['tanggal_donasi'];
    $tanggal_donasi_formatted = str_replace('T', ' ', $tanggal_donasi) . ':00';


    if ($id_donasi === false || $jumlah_donasi === false || $jumlah_donasi < 10000 || $kategori_id === false) {
        header("Location: data_donasi.php?status=update_invalid");
        exit();
    }
    
    // 2. Query UPDATE
    $query_update = "UPDATE donasi SET 
                    nama_donatur = ?, 
                    jumlah_donasi = ?, 
                    id_kategori = ?, 
                    status_pembayaran = ?,
                    tanggal_donasi = ?
                    WHERE id_donasi = ?";
                    
    $stmt_update = mysqli_prepare($koneksi, $query_update);
    
    // Bind Parameter: s, d, i, s, s (data baru) dan i (ID)
    mysqli_stmt_bind_param($stmt_update, "sdissi", 
        $nama_donatur, 
        $jumlah_donasi, 
        $kategori_id, 
        $status_pembayaran, 
        $tanggal_donasi_formatted,
        $id_donasi // ID diletakkan di akhir untuk klausa WHERE
    );

    // 3. Eksekusi dan Redirect
    if (mysqli_stmt_execute($stmt_update)) {
        mysqli_stmt_close($stmt_update);
        header("Location: data_donasi.php?status=updated");
        exit();
    } else {
        mysqli_stmt_close($stmt_update);
        die("Error saat mengupdate data: " . mysqli_stmt_error($stmt_update));
    }

} else {
    // Jika diakses tanpa ID atau POST data
    header("Location: data_donasi.php");
    exit();
}


// --- Query untuk mengambil semua kategori untuk dropdown di Form ---
$query_kategori = "SELECT id_kategori, nama_kategori FROM kategori ORDER BY nama_kategori ASC";
$result_kategori = mysqli_query($koneksi, $query_kategori);
$list_kategori = mysqli_fetch_all($result_kategori, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✏️ Edit Data Donasi</title>
    <link rel="stylesheet" href="style_futuristik.css">
    <style>
        .form-section {
            padding: 120px 20px 80px;
            background-color: var(--color-dark);
            min-height: 100vh;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 224, 255, 0.2);
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--color-light);
            font-weight: 500;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #3c3c3c;
            border-radius: 4px;
            background-color: #2a2a2a;
            color: var(--color-light);
            box-sizing: border-box;
        }
        .btn-submit {
            background-color: var(--color-accent);
            color: var(--color-dark);
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #00ffff;
        }
        .error-message {
            color: #f44336;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #f44336;
            border-radius: 4px;
            background-color: rgba(244, 67, 54, 0.1);
        }
    </style>
</head>
<body>

    <main class="form-section">
        <div class="form-container">
            <h2>Edit Transaksi #<?php echo htmlspecialchars($data_lama['id_donasi']); ?></h2>
            <span class="subtitle">Perbarui data donasi di bawah ini:</span>

            <form action="update.php" method="POST">
                
                <input type="hidden" name="id_donasi" value="<?php echo htmlspecialchars($data_lama['id_donasi']); ?>">

                <div class="form-group">
                    <label for="nama_donatur">Nama Donatur</label>
                    <input type="text" id="nama_donatur" name="nama_donatur" value="<?php echo htmlspecialchars($data_lama['nama_donatur']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_donasi">Jumlah Donasi (Rp)</label>
                    <input type="number" step="any" id="jumlah_donasi" name="jumlah_donasi" value="<?php echo htmlspecialchars($data_lama['jumlah_donasi']); ?>" required min="10000">
                </div>

                <div class="form-group">
                    <label for="kategori_id">Target Kategori</label>
                    <select id="kategori_id" name="kategori_id" required>
                        <?php foreach ($list_kategori as $kategori): ?>
                            <option 
                                value="<?php echo htmlspecialchars($kategori['id_kategori']); ?>"
                                <?php if ($kategori['id_kategori'] == $data_lama['id_kategori']) echo 'selected'; ?>
                            >
                                <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_pembayaran">Metode Pembayaran</label>
                    <select id="status_pembayaran" name="status_pembayaran" required>
                        <?php $statuses = ['BCA Virtual Account']; ?>
                        <?php foreach ($statuses as $status): ?>
                            <option 
                                value="<?php echo $status; ?>"
                                <?php if ($status == $data_lama['status_pembayaran']) echo 'selected'; ?>
                            >
                                <?php echo $status; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="tanggal_donasi">Waktu Transaksi</label>
                    <?php 
                        $datetime_local = date('Y-m-d\TH:i', strtotime($data_lama['tanggal_donasi']));
                    ?>
                    <input type="datetime-local" id="tanggal_donasi" name="tanggal_donasi" value="<?php echo $datetime_local; ?>" required>
                </div>

                <button type="submit" class="btn-submit">Simpan Perubahan</button>
                <a href="data_donasi.php" style="color: var(--color-accent); margin-left: 10px; text-decoration: none;">Batal</a>
            </form>
        </div>
    </main>

</body>
</html>