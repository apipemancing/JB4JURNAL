<?php
include 'koneksi.php';

if(isset($_GET['nomor_absen'])) {
    $nomor_absen = $_GET['nomor_absen'];

    $query = "DELETE FROM jurnal WHERE nomor_absen = '$nomor_absen'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: hasil_pengisian.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Nomor absen tidak diberikan.";
}
?>
