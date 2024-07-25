<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Ikan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Form Tambah Data Ikan</h2>
    <form action="insertData.php" method="POST">
        <label for="kategori">Kategori Ikan:</label>
        <select id="kategori" name="kategori" required>
            <option value="Ikan 1">Ikan 1</option>
            <option value="Ikan 2">Ikan 2</option>
        </select><br><br>
        <label for="minggu">Minggu:</label>
        <input type="number" id="minggu" name="minggu" required><br><br>
        <label for="berat">Berat:</label>
        <input type="number" id="berat" name="berat" step="any" required><br><br>
        <button type="submit">Tambahkan Data</button>
    </form>
</body>
</html>
