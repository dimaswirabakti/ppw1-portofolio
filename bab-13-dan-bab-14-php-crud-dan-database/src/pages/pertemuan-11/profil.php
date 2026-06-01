<?php
$nama  = "Nyoman Dimas Wira Bakti";
$nim   = "25/561741/SV/26643";
$prodi = "Teknologi Rekayasa Perangkat Lunak";
$kota  = "Gianyar";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Mahasiswa</title>
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

        h1 {
            color: #333;
        }
    </style>
</head>

<body>
    <h1>Profil Mahasiswa</h1>
    <a href="/">Home</a>
    <hr>
    <table>
        <tr>
            <th>Nama</th>
            <td><?= $nama ?></td>
        </tr>
        <tr>
            <th>NIM</th>
            <td><?= $nim ?></td>
        </tr>
        <tr>
            <th>Prodi</th>
            <td><?= $prodi ?></td>
        </tr>
        <tr>
            <th>Asal Kota</th>
            <td><?= $kota ?></td>
        </tr>
    </table>
</body>

</html>