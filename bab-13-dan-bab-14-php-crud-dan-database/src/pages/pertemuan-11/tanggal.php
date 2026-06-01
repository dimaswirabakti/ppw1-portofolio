<?php
$namaBulan   = date('F');
$totalHari   = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
$hariIni     = (int) date('j');
$hariTersisa = $totalHari - $hariIni;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Info Bulan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .info {
            background: #eef;
            padding: 16px;
            border-radius: 8px;
            width: 380px;
            margin-top: 12px;
        }

        .info p {
            margin: 8px 0;
            font-size: 1.05em;
        }

        span {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <h1>Informasi Bulan Sekarang</h1>
    <a href="/">Home</a>
    <hr>
    <div class="info">
        <p>Bulan sekarang : <span><?= $namaBulan ?></span></p>
        <p>Tanggal hari ini : <span><?= date('d/m/Y') ?></span></p>
        <p>Jumlah hari di bulan ini : <span><?= $totalHari ?> hari</span></p>
        <p>Hari yang sudah berlalu : <span><?= $hariIni ?> hari</span></p>
        <p>Hari tersisa : <span><?= $hariTersisa ?> hari</span></p>
    </div>
</body>

</html>