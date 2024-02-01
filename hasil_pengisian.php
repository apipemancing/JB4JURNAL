<?php
include 'koneksi.php';

// Pengecekan apakah data baru dikirimkan melalui formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nomor_absen = $_POST['nomor_absen'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $kegiatan = $_POST['kegiatan'];

    // Insert data baru ke dalam database
    $insertQuery = "INSERT INTO jurnal (nomor_absen, nama, kelas, jurusan, tanggal, waktu, Kegiatan) VALUES ('$nomor_absen', '$nama', '$kelas', '$jurusan', '$tanggal', '$waktu', '$kegiatan')";
    $insertResult = mysqli_query($koneksi, $insertQuery);

    if (!$insertResult) {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Tampilkan data dari tabel jurnal
$query = "SELECT * FROM jurnal";
$result = mysqli_query($koneksi, $query);

if ($result) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Pengisian Jurnal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Table Pengisian Jurnal</h2>

    <!-- Formulir untuk menambahkan data baru -->
    <form method="post" action="">
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

        <label>Waktu Kegiatan:</label>
        <input type="text" name="waktu" placeholder="Mulai - Selesai" required>

        <label>Kegiatan:</label>
        <input type="text" name="kegiatan" required>

        <button type="submit">Tambah Data</button>
    </form>

    <!-- Tabel untuk menampilkan data -->
    <table>
        <thead>
            <tr>
                <th>Nomor Absen</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Tanggal</th>
                <th>Waktu Kegiatan</th>
                <th>Kegiatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nomor_absen'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['kelas'] . "</td>";
                echo "<td>" . $row['jurusan'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . $row['waktu'] . "</td>";
                echo "<td>" . $row['Kegiatan'] . "</td>";
                echo "<td><a href='edit_data.php?nomor_absen=" . $row['nomor_absen'] . "'>Edit</a> | <a href='hapus_data.php?nomor_absen=" . $row['nomor_absen'] . "'>Hapus</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
