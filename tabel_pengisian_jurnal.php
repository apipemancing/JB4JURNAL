<?php
// Pastikan path ke file koneksi.php adalah yang benar
include 'koneksi.php';

// Proses pengisian jurnal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor_absen = $_POST['nomor_absen'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $Kegiatan = $_POST['Kegiatan'];

    // Membuat kueri SQL untuk menyimpan data
    $query = "INSERT INTO jurnal (nomor_absen, nama, kelas, jurusan, tanggal, waktu, Kegiatan) VALUES ('$nomor_absen', '$nama', '$kelas', '$jurusan', '$tanggal', '$waktu', '$Kegiatan')";

    // Melakukan kueri SQL
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Data berhasil disimpan, lakukan redirect
        header("Location: hasil_pengisian.php");
        exit(); // Pastikan untuk keluar setelah header redirect
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengisian Jurnal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Form Pengisian Jurnal</h2>
    <form method="post" action="">
        <!-- Tambahkan input fields sesuai dengan kolom tabel -->
        <label>Nomor Absen:</label>
        <input type="text" name="nomor_absen" required>

        <label>Nama:</label>
        <input type="text" name="nama" required>

        <label>Kelas:</label>
        <select name="kelas" required>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
        </select>

        <label>Jurusan:</label>
        <input type="text" name="jurusan" required>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>

        <!-- Ubah input Jam Datang menjadi time - time -->
        <label>Waktu Kegiatan:</label>
        <input type="text" name="waktu" id="waktu" required placeholder="Mulai - Selesai">

        <!-- Ubah input Jam Pulang menjadi kegiatan (text) -->
        <label>Kegiatan:</label>
        <input type="text" name="Kegiatan" id="Kegiatan" required>

        <button type="submit">Simpan Data</button>
    </form>
</body>
</html>