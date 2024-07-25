<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Ikan</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        table {
            width: 50%; /* Mengubah lebar tabel menjadi 50% dari lebar halaman */
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            color: white;
            background-color: red;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Minggu</th>
            <th>Berat</th>
            <th>Aksi</th>
        </tr>

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

        // Query untuk mengambil data dari tabel beratikan, diurutkan berdasarkan kategori dan minggu
        $sql = "SELECT id, kategori, minggu, berat FROM beratikan ORDER BY kategori ASC, minggu ASC";
        $result = $koneksi->query($sql);

        // Periksa jika ada data yang ditemukan
        if ($result->num_rows > 0) {
            $no = 1;
            $current_kategori = ''; // Variabel untuk menyimpan kategori saat ini

            // Tampilkan data per baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['kategori']) . "</td>"; // Melindungi output dari XSS
                echo "<td>" . htmlspecialchars($row['minggu']) . "</td>"; // Melindungi output dari XSS
                echo "<td>" . htmlspecialchars($row['berat']) . "</td>"; // Melindungi output dari XSS
                echo "<td><button onclick=\"hapusData(" . $row['id'] . ")\">Hapus</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data yang ditemukan</td></tr>";
        }

        // Tutup koneksi database
        $koneksi->close();
        ?>
    </table>

    <script>
        function hapusData(id) {
            // Kirim permintaan AJAX untuk menghapus data ke PHP tanpa konfirmasi
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'hapusData.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Refresh halaman setelah penghapusan data
                    // location.reload();
                }
            };
            xhr.send('id=' + id); // Kirim ID data yang akan dihapus
        }
    </script>
</body>
</html>
