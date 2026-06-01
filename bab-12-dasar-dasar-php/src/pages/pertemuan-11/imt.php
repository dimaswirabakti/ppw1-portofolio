<?php
function hitungIMT($berat, $tinggi)
{
    $tinggMeter = $tinggi / 100;
    $imt = $berat / ($tinggMeter * $tinggMeter);

    if ($imt < 18.5) {
        $kategori = 'Kurus';
    } elseif ($imt < 25) {
        $kategori = 'Normal';
    } elseif ($imt < 30) {
        $kategori = 'Gemuk';
    } else {
        $kategori = 'Obesitas';
    }

    return ['imt' => round($imt, 2), 'kategori' => $kategori];
}

$berat  = 63;
$tinggi = 174;
$hasil  = hitungIMT($berat, $tinggi);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kalkulator IMT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 400px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 10px 14px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            width: 140px;
        }

        .kategori {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Kalkulator IMT</h1>
    <a href="/">Home</a>
    <hr>
    <table>
        <tr>
            <th>Berat Badan</th>
            <td><?= $berat ?> kg</td>
        </tr>
        <tr>
            <th>Tinggi Badan</th>
            <td><?= $tinggi ?> cm</td>
        </tr>
        <tr>
            <th>Nilai IMT</th>
            <td><?= $hasil['imt'] ?></td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td class="kategori"><?= $hasil['kategori'] ?></td>
        </tr>
    </table>
</body>

</html>