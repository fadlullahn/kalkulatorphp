<?php
// Koneksi ke database (ganti dengan informasi koneksi Anda)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kalkulator';

// Ambil ID yang dikirim dari JavaScript
$id = $_POST['id'];

// Buat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query hapus data
$sql = "DELETE FROM beratikan WHERE id = $id";

if ($koneksi->query($sql) === TRUE) {
    // Tutup koneksi database
    $koneksi->close();
} else {
    // Jika terjadi kesalahan
    echo "Error: " . $sql . "<br>" . $koneksi->error;
    // Tutup koneksi database dalam kasus error
    $koneksi->close();
    exit(); // Berhenti jika terjadi kesalahan
}

// Memberikan respons kosong kepada JavaScript
echo "";
