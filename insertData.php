<?php
// Koneksi ke database (ganti dengan informasi koneksi Anda)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kalkulator';

// Buat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil nilai yang dikirimkan melalui form
$kategori = $_POST['kategori'];
$minggu = $_POST['minggu'];
$berat = $_POST['berat'];

// Siapkan query untuk menyimpan data ke database
$sql = "INSERT INTO beratikan (kategori, minggu, berat) VALUES ('$kategori', '$minggu', '$berat')";

// Eksekusi query
if ($koneksi->query($sql) === TRUE) {
    echo "Data berhasil ditambahkan.";
    // Redirect kembali ke halaman sebelumnya
    echo '<script>window.history.back();</script>';
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
