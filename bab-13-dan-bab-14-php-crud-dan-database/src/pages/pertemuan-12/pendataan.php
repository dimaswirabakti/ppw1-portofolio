<?php
// Tugas 2: Pendataan Mahasiswa dan Predikat Kelulusan

function bersihkan($input): string
{
    return htmlspecialchars(stripslashes(trim($input)));
}

function predikatKelulusan($ipk): array
{
    if ($ipk >= 3.51) return ['predikat' => 'Dengan Pujian (Cumlaude)', 'warna' => 'success'];
    if ($ipk >= 3.01) return ['predikat' => 'Sangat Memuaskan', 'warna' => 'primary'];
    if ($ipk >= 2.76) return ['predikat' => 'Memuaskan', 'warna' => 'info'];
    if ($ipk >= 2.00) return ['predikat' => 'Cukup', 'warna' => 'warning'];
    return ['predikat' => 'Tidak Lulus', 'warna' => 'danger'];
}

$prodi_list = ['TRPL', 'TRE', 'TRI', 'TRIK', 'MPP'];
$errors = [];
$sukses = false;
$data = null;
$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = bersihkan($_POST['nama']  ?? '');
    $nim = bersihkan($_POST['nim'] ?? '');
    $prodi = bersihkan($_POST['prodi'] ?? '');
    $ipk = $_POST['ipk'] ?? '';
    $semester = $_POST['semester'] ?? '';

    if (empty($nama)) $errors[] = "Nama tidak boleh kosong.";
    elseif (strlen($nama) < 3)
        $errors[] = "Nama minimal 3 karakter.";

    if (empty($nim)) $errors[] = "NIM tidak boleh kosong.";
    elseif (!preg_match('/^\d{2}\/\d{6}\/[A-Z]{2}\/\d{5}$/', $nim))
        $errors[] = "Format NIM tidak valid. Contoh: 25/123456/SV/12345";

    if (!in_array($prodi, $prodi_list))
        $errors[] = "Program studi tidak valid.";

    if ($ipk === '') $errors[] = "IPK tidak boleh kosong.";
    elseif (!is_numeric($ipk) || $ipk < 0 || $ipk > 4)
        $errors[] = "IPK harus antara 0.00 hingga 4.00.";

    if ($semester === '') $errors[] = "Semester tidak boleh kosong.";
    elseif (!is_numeric($semester) || $semester < 1 || $semester > 14)
        $errors[] = "Semester harus antara 1 hingga 14.";

    if (empty($errors)) {
        $stmt = $db->prepare(
            "INSERT INTO pendataan (nama, nim, prodi, ipk, semester)
             VALUES (:nama, :nim, :prodi, :ipk, :semester)"
        );
        $stmt->execute([
            ':nama' => $nama,
            ':nim' => $nim,
            ':prodi' => $prodi,
            ':ipk' => (float) $ipk,
            ':semester' => (int) $semester,
        ]);
        $sukses = true;
        $data = [
            'nama' => $nama,
            'nim' => $nim,
            'prodi' => $prodi,
            'ipk' => (float) $ipk,
            'semester' => (int) $semester,
            'predikat' => predikatKelulusan((float) $ipk),
        ];
    }
}

$riwayat = $db->query("SELECT * FROM pendataan ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendataan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4" style="max-width:650px">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Pendataan Mahasiswa</h2>
            <a href="/" class="btn btn-secondary btn-sm">Home</a>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $e): ?>
                        <li><?= $e ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($sukses): ?>
            <div class="alert alert-success">Data berhasil disimpan!</div>
        <?php endif; ?>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control"
                            value="<?= bersihkan($_POST['nama'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                        <input type="text" name="nim" class="form-control"
                            value="<?= bersihkan($_POST['nim'] ?? '') ?>"
                            placeholder="25/123456/SV/12345" required>
                        <div class="form-text">Format: 25/123456/SV/12345</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                        <select name="prodi" class="form-select" required>
                            <option value="">Pilih Prodi</option>
                            <?php foreach ($prodi_list as $p): ?>
                                <option value="<?= $p ?>" <?= (($_POST['prodi'] ?? '') === $p) ? 'selected' : '' ?>>
                                    <?= $p ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label fw-semibold">IPK <span class="text-danger">*</span></label>
                            <input type="number" name="ipk" class="form-control"
                                step="0.01" min="0" max="4"
                                value="<?= htmlspecialchars($_POST['ipk'] ?? '') ?>"
                                placeholder="0.00 – 4.00" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label fw-semibold">Semester <span class="text-danger">*</span></label>
                            <input type="number" name="semester" class="form-control"
                                min="1" max="14"
                                value="<?= htmlspecialchars($_POST['semester'] ?? '') ?>"
                                placeholder="1 – 14" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                </form>
            </div>
        </div>

        <?php if ($data): ?>
            <div class="card shadow border-<?= $data['predikat']['warna'] ?> border-2 mb-4">
                <div class="card-header bg-<?= $data['predikat']['warna'] ?> text-white fw-bold">
                    Data Tersimpan
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-3">
                        <tr>
                            <th style="width:120px">Nama</th>
                            <td><?= $data['nama'] ?></td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td><?= $data['nim'] ?></td>
                        </tr>
                        <tr>
                            <th>Prodi</th>
                            <td><?= $data['prodi'] ?></td>
                        </tr>
                        <tr>
                            <th>IPK</th>
                            <td><?= number_format($data['ipk'], 2) ?></td>
                        </tr>
                        <tr>
                            <th>Semester</th>
                            <td><?= $data['semester'] ?></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <span class="badge bg-<?= $data['predikat']['warna'] ?> fs-6 px-4 py-2">
                            <?= $data['predikat']['predikat'] ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($riwayat)): ?>
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Riwayat Data Tersimpan</div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Prodi</th>
                                <th>IPK</th>
                                <th>Sem</th>
                                <th>Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($riwayat as $i => $r): ?>
                                <?php $p = predikatKelulusan($r['ipk']); ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($r['nama']) ?></td>
                                    <td><?= htmlspecialchars($r['nim']) ?></td>
                                    <td><?= htmlspecialchars($r['prodi']) ?></td>
                                    <td><?= number_format($r['ipk'], 2) ?></td>
                                    <td><?= $r['semester'] ?></td>
                                    <td>
                                        <span class="badge bg-<?= $p['warna'] ?>">
                                            <?= $p['predikat'] ?>
                                        </span>
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