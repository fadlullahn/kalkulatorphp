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

// Query untuk mengambil data dari tabel beratikan untuk Kategori 1
$sql_kategori1 = "SELECT minggu, berat FROM beratikan WHERE kategori = 'Ikan 1' ORDER BY minggu ASC";
$result_kategori1 = $koneksi->query($sql_kategori1);

// Query untuk mengambil data dari tabel beratikan untuk Kategori 2
$sql_kategori2 = "SELECT minggu, berat FROM beratikan WHERE kategori = 'Ikan 2' ORDER BY minggu ASC";
$result_kategori2 = $koneksi->query($sql_kategori2);

// Array untuk menyimpan data yang akan dikirim ke JavaScript
$data_kategori1 = [];
$data_kategori2 = [];
$labels = []; // Array untuk menyimpan labels

// Mengambil data untuk Kategori 1
if ($result_kategori1->num_rows > 0) {
    while ($row = $result_kategori1->fetch_assoc()) {
        $data_kategori1[] = [
            'minggu' => $row['minggu'],
            'berat' => $row['berat']
        ];
        // Memasukkan minggu ke dalam array labels (pastikan tidak ada duplikasi)
        if (!in_array("Minggu " . $row['minggu'], $labels)) {
            $labels[] = "Minggu " . $row['minggu'];
        }
    }
}

// Mengambil data untuk Kategori 2
if ($result_kategori2->num_rows > 0) {
    while ($row = $result_kategori2->fetch_assoc()) {
        $data_kategori2[] = [
            'minggu' => $row['minggu'],
            'berat' => $row['berat']
        ];
        // Memasukkan minggu ke dalam array labels (pastikan tidak ada duplikasi)
        if (!in_array("Minggu " . $row['minggu'], $labels)) {
            $labels[] = "Minggu " . $row['minggu'];
        }
    }
}

// Fungsi custom untuk mengurutkan labels berdasarkan angka minggu
usort($labels, function ($a, $b) {
    $numA = (int) filter_var($a, FILTER_SANITIZE_NUMBER_INT);
    $numB = (int) filter_var($b, FILTER_SANITIZE_NUMBER_INT);
    return $numA - $numB;
});

// Format data untuk dikirim ke JavaScript
$response = [
    'labels' => $labels,
    'kategori1' => $data_kategori1,
    'kategori2' => $data_kategori2
];

// Mengubah array PHP menjadi JSON dan mengirimkannya sebagai respons
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$koneksi->close();
