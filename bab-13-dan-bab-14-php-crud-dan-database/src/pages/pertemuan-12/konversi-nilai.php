<?php
function konversiNilai($nilai)
{
    if ($nilai >= 85) return ['grade' => 'A', 'deskripsi' => 'Sangat Baik', 'warna' => 'success'];
    if ($nilai >= 70) return ['grade' => 'B', 'deskripsi' => 'Baik', 'warna' => 'primary'];
    if ($nilai >= 55) return ['grade' => 'C', 'deskripsi' => 'Cukup', 'warna' => 'warning'];
    if ($nilai >= 40) return ['grade' => 'D', 'deskripsi' => 'Kurang', 'warna' => 'orange'];
    return ['grade' => 'E', 'deskripsi' => 'Sangat Kurang', 'warna' => 'danger'];
}

$hasil = null;
$nilai_input = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nilai_input = (int) ($_POST['nilai'] ?? -1);
    if ($nilai_input < 0 || $nilai_input > 100) {
        $error = "Nilai harus antara 0 hingga 100.";
    } else {
        $hasil = konversiNilai($nilai_input);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konversi Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .grade-badge {
            font-size: 4rem;
            font-weight: bold;
        }

        .border-orange {
            border-color: #fd7e14 !important;
        }

        .text-orange {
            color: #fd7e14 !important;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4" style="max-width: 500px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Konversi Nilai</h2>
            <a href="/" class="btn btn-secondary btn-sm">Home</a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Masukkan Nilai (0-100)</label>
                        <input type="number" name="nilai" class="form-control form-control-lg"
                            min="0" max="100" value="<?= htmlspecialchars($nilai_input) ?>"
                            placeholder="Contoh: 78" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Konversi</button>
                </form>
            </div>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($hasil): ?>
            <?php
            $w = $hasil['warna'];
            $borderClass = $w === 'orange' ? 'border-orange' : "border-{$w}";
            $textClass = $w === 'orange' ? 'text-orange' : "text-{$w}";
            $bgClass = $w === 'orange' ? 'bg-orange text-white' : "bg-{$w}" . ($w === 'warning' ? '' : ' text-white');
            ?>
            <div class="card shadow border-3 <?= $borderClass ?>">
                <div class="card-body text-center py-4">
                    <div class="grade-badge <?= $textClass ?>"><?= $hasil['grade'] ?></div>
                    <h4 class="mt-2"><?= $hasil['deskripsi'] ?></h4>
                    <p class="text-muted mb-3">Nilai yang dimasukkan: <strong><?= $nilai_input ?></strong></p>
                    <span class="badge fs-6 px-4 py-2 <?= $bgClass ?>"><?= $hasil['grade'] ?> : <?= $hasil['deskripsi'] ?></span>
                </div>
            </div>

            <div class="card mt-3 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Tabel Referensi Grade</h6>
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Grade</th>
                                <th>Rentang</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-success">
                                <td><strong>A</strong></td>
                                <td>85 - 100</td>
                                <td>Sangat Baik</td>
                            </tr>
                            <tr class="table-primary">
                                <td><strong>B</strong></td>
                                <td>70 - 84</td>
                                <td>Baik</td>
                            </tr>
                            <tr class="table-warning">
                                <td><strong>C</strong></td>
                                <td>55 - 69</td>
                                <td>Cukup</td>
                            </tr>
                            <tr style="background:#ffe5cc">
                                <td><strong>D</strong></td>
                                <td>40 - 54</td>
                                <td>Kurang</td>
                            </tr>
                            <tr class="table-danger">
                                <td><strong>E</strong></td>
                                <td>0 - 39</td>
                                <td>Sangat Kurang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>