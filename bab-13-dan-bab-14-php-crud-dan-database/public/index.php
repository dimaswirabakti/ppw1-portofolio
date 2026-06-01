<?php

$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

require_once __DIR__ . '/../config/database.php';

$page     = $_GET['page'] ?? 'home';
$allowed = [
    'home',
    'pertemuan-11/profil',
    'pertemuan-11/imt',
    'pertemuan-11/tanggal',
    'pertemuan-11/kalkulator',
    'pertemuan-12/crud/index',
    'pertemuan-12/crud/create',
    'pertemuan-12/crud/edit',
    'pertemuan-12/konversi-nilai',
    'pertemuan-12/pendataan',
];

if (!in_array($page, $allowed)) {
    http_response_code(404);
    echo "<h1>404 - Halaman tidak ditemukan</h1>";
    exit;
}

$pageFile = __DIR__ . '/../src/pages/' . $page . '.php';
if (file_exists($pageFile)) {
    require $pageFile;
} else {
    echo "<h1>Halaman belum dibuat</h1>";
}
