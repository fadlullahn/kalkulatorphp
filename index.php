<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Line Chart Example with PHP and MySQL</title>
    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <canvas id="myChart" width="300" height="300"></canvas>

    <script>
        // Fungsi untuk memodifikasi label
        function modifyLabels(labels) {
            for (let i = 0; i < labels.length; i++) {
                if (labels[i] === "Minggu 0") {
                    labels[i] = "Berat Awal";
                }
            }
            return labels;
        }

        // Fungsi untuk mengambil data dari server menggunakan AJAX
        function getDataFromServer() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getData.php', true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = JSON.parse(xhr.responseText);
                    var labels = response.labels;
                    var data_kategori1 = response.kategori1.map(item => item.berat);
                    var data_kategori2 = response.kategori2.map(item => item.berat);

                    // Memodifikasi label sebelum digunakan dalam Chart.js
                    labels = modifyLabels(labels);

                    // Konfigurasi Chart.js
                    var ctx = document.getElementById("myChart").getContext("2d");
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Ikan 1',
                                data: data_kategori1,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                fill: false
                            }, {
                                label: 'Ikan 2',
                                data: data_kategori2,
                                borderColor: 'rgba(255, 99, 132, 1)',
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                                x: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } else {
                    console.error('Gagal mengambil data: ' + xhr.statusText);
                }
            };

            xhr.onerror = function() {
                console.error('Request gagal');
            };

            xhr.send();
        }

        // Panggil fungsi untuk mengambil data dari server saat halaman dimuat
        getDataFromServer();
    </script>
</body>

</html>