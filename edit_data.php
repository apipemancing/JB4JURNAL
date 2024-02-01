<?php
include 'koneksi.php';

// Mengecek apakah nomor absen ada di URL
if (isset($_GET['nomor_absen'])) {
    // Mendapatkan nomor absen dari URL
    $nomor_absen = $_GET['nomor_absen'];

    // Proses update data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $jurusan = $_POST['jurusan'];
        $tanggal = $_POST['tanggal'];
        $waktu = $_POST['waktu'];
        $kegiatan = $_POST['Kegiatan'];

        // Update data di database
        $query = "UPDATE jurnal SET nama='$nama', kelas='$kelas', jurusan='$jurusan', tanggal='$tanggal', waktu='$waktu', Kegiatan='$kegiatan' WHERE nomor_absen='$nomor_absen'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            header("Location: hasil_pengisian.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }

    // Ambil data dari database
    $query = "SELECT * FROM jurnal WHERE nomor_absen='$nomor_absen'";
    $result = mysqli_query($koneksi, $query);

    // Mengecek apakah data ditemukan
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Data</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h2>Edit Data</h2>
            <form method="post" action="">
                <!-- Tambahkan input fields sesuai dengan kolom tabel -->
                <label>Nomor Absen:</label>
                <input type="text" name="nomor_absen" value="<?php echo $row['nomor_absen']; ?>" readonly>

                <label>Nama:</label>
                <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>

                <label>Kelas:</label>
                <select name="kelas" required>
                    <option value="X" <?php echo ($row['kelas'] == 'X') ? 'selected' : ''; ?>>X</option>
                    <option value="XI" <?php echo ($row['kelas'] == 'XI') ? 'selected' : ''; ?>>XI</option>
                    <option value="XII" <?php echo ($row['kelas'] == 'XII') ? 'selected' : ''; ?>>XII</option>
                </select>

                <label>Jurusan:</label>
                <input type="text" name="jurusan" value="<?php echo $row['jurusan']; ?>" required>

                <label>Tanggal:</label>
                <input type="date" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>

                <!-- Ubah input Jam Datang menjadi time - time -->
                <label>Waktu Kegiatan:</label>
                <input type="text" name="waktu" value="<?php echo $row['waktu']; ?>" required placeholder="Mulai - Selesai">

                <!-- Ubah input Jam Pulang menjadi kegiatan (text) -->
                <label>Kegiatan:</label>
                <input type="text" name="Kegiatan" value="<?php echo $row['Kegiatan']; ?>" required>

                <button type="submit">Update Data</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "Nomor absen tidak ditemukan.";
}
?>
