<?php
// Halaman Daftar Mahasiswa

$db = getDB();

// Proses hapus data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_id'])) {
    $id = (int) $_POST['hapus_id'];
    $stmt = $db->prepare("DELETE FROM mahasiswa WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $pesan_sukses = "Data berhasil dihapus.";
}

$stmt = $db->query("SELECT * FROM mahasiswa ORDER BY id DESC");
$data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Daftar Mahasiswa</h2>
            <div>
                <a href="/" class="btn btn-secondary btn-sm me-1">Home</a>
                <a href="/?page=pertemuan-12/crud/create" class="btn btn-primary btn-sm">+ Tambah</a>
            </div>
        </div>

        <?php if (isset($pesan_sukses)): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $pesan_sukses ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (empty($data)): ?>
            <div class="alert alert-info">Belum ada data mahasiswa.</div>
        <?php else: ?>
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($row['nim']) ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['jurusan']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td>
                                        <a href="/?page=pertemuan-12/crud/edit&id=<?= $row['id'] ?>"
                                            class="btn btn-warning btn-sm">Edit</a>

                                        <form method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            <input type="hidden" name="hapus_id" value="<?= $row['id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>