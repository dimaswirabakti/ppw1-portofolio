<?php
// Halaman Edit Mahasiswa

$db = getDB();

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /?page=pertemuan-12/crud/index');
    exit;
}

// Ambil data yang akan diedit
$stmt = $db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();

if (!$row) {
    header('Location: /?page=pertemuan-12/crud/index');
    exit;
}

$errors = [];
$sukses = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    // Validasi
    if (empty($nim)) $errors[] = "NIM tidak boleh kosong.";
    elseif (!preg_match('/^\d{2}\/\d{6}\/[A-Z]{2}\/\d{5}$/', $nim))
        $errors[] = "Format NIM tidak valid. Contoh: 25/123456/SV/12345";
    if (empty($nama)) $errors[] = "Nama tidak boleh kosong.";
    if (empty($jurusan)) $errors[] = "Jurusan tidak boleh kosong.";
    if (empty($email)) $errors[] = "Email tidak boleh kosong.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Format email tidak valid.";

    // Cek NIM duplikat (kecuali milik sendiri)
    if (empty($errors)) {
        $cek = $db->prepare("SELECT id FROM mahasiswa WHERE nim = :nim AND id != :id");
        $cek->execute([':nim' => $nim, ':id' => $id]);
        if ($cek->fetch()) $errors[] = "NIM sudah digunakan mahasiswa lain.";
    }

    if (empty($errors)) {
        $stmt = $db->prepare(
            "UPDATE mahasiswa
             SET nim = :nim, nama = :nama, jurusan = :jurusan,
                 email = :email, alamat = :alamat
             WHERE id = :id"
        );
        $stmt->execute([
            ':nim'     => $nim,
            ':nama'    => $nama,
            ':jurusan' => $jurusan,
            ':email'   => $email,
            ':alamat'  => $alamat,
            ':id'      => $id,
        ]);
        $sukses = true;
        // Refresh data setelah update
        $stmt2 = $db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt2->execute([':id' => $id]);
        $row = $stmt2->fetch();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Edit Mahasiswa</h2>
            <a href="/?page=pertemuan-12/crud/index" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        <?php if ($sukses): ?>
            <div class="alert alert-success">Data berhasil diperbarui!</div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="/?page=pertemuan-12/crud/edit&id=<?= $id ?>">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                        <input type="text" name="nim" class="form-control"
                            value="<?= htmlspecialchars($_POST['nim'] ?? $row['nim']) ?>" required>
                        <div class="form-text">Format: 25/123456/SV/12345</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control"
                            value="<?= htmlspecialchars($_POST['nama'] ?? $row['nama']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jurusan <span class="text-danger">*</span></label>
                        <input type="text" name="jurusan" class="form-control"
                            value="<?= htmlspecialchars($_POST['jurusan'] ?? $row['jurusan']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control"
                            value="<?= htmlspecialchars($_POST['email'] ?? $row['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3"><?= htmlspecialchars($_POST['alamat'] ?? $row['alamat']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Perbarui Data</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>