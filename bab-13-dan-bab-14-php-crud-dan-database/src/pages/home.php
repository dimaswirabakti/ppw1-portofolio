<?php
// Test koneksi database
try {
    $db = getDB();
    $status = "Koneksi ke database <strong>ppw</strong> berhasil!";
} catch (Exception $e) {
    $status = "Koneksi gagal.";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Praktikum Pemrograman Web 1</title>
</head>

<body>
    <h1>Praktikum Pemrograman Web</h1>
    <p><?= $status ?></p>
    <ul>
        <li><a href="http://localhost:8081" target="_blank">Adminer (DB GUI)</a></li>
        <br>
        <li><a href="/?page=pertemuan-11/profil">Pertemuan 11: Profil Mahasiswa</a></li>
        <li><a href="/?page=pertemuan-11/imt">Pertemuan 11: Kalkulator IMT</a></li>
        <li><a href="/?page=pertemuan-11/tanggal">Pertemuan 11: Info Bulan</a></li>
        <li><a href="/?page=pertemuan-11/kalkulator">Pertemuan 11: Kalkulator</a></li>
        <br>
        <li><a href="/?page=pertemuan-12/crud/index">Pertemuan 12 — CRUD Mahasiswa</a></li>
        <li><a href="/?page=pertemuan-12/konversi-nilai">Pertemuan 12 — Konversi Nilai</a></li>
        <li><a href="/?page=pertemuan-12/pendataan">Pertemuan 12 — Pendataan Mahasiswa</a></li>
    </ul>
</body>

</html>