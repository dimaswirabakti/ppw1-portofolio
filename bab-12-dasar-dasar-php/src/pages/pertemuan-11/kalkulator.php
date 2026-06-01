<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kalkulator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .kalkulator {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            width: 320px;
            border-radius: 8px;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            font-size: 1em;
        }

        .tombol-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        button {
            flex: 1 1 40%;
            padding: 10px;
            font-size: 1em;
            cursor: pointer;
            background: #4a90e2;
            color: white;
            border: none;
            border-radius: 6px;
        }

        button:hover {
            background: #357abd;
        }

        .hasil {
            margin-top: 16px;
            font-size: 1.2em;
            font-weight: bold;
            background: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 6px;
            min-height: 40px;
        }
    </style>
</head>

<body>
    <h1>Kalkulator</h1>
    <a href="/">Home</a>
    <hr>

    <div class="kalkulator">
        <label>Bilangan Pertama</label>
        <input type="number" id="angka1" placeholder="Masukkan angka...">

        <label>Bilangan Kedua</label>
        <input type="number" id="angka2" placeholder="Masukkan angka...">

        <div class="tombol-group">
            <button onclick="hitung('+')">Tambah (+)</button>
            <button onclick="hitung('-')">Kurang (-)</button>
            <button onclick="hitung('*')">Kali (x)</button>
            <button onclick="hitung('/')">Bagi (/)</button>
        </div>

        <div class="hasil" id="hasil">Hasil:</div>
    </div>

    <script>
        function hitung(operator) {
            const a = parseFloat(document.getElementById('angka1').value);
            const b = parseFloat(document.getElementById('angka2').value);

            if (isNaN(a) || isNaN(b)) {
                document.getElementById('hasil').textContent = 'Masukkan kedua bilangan!';
                return;
            }

            let hasil;
            let simbol;

            if (operator === '+') {
                hasil = a + b;
                simbol = '+';
            } else if (operator === '-') {
                hasil = a - b;
                simbol = '-';
            } else if (operator === '*') {
                hasil = a * b;
                simbol = 'x';
            } else if (operator === '/') {
                if (b === 0) {
                    document.getElementById('hasil').textContent = 'Error: tidak bisa dibagi 0!';
                    return;
                }
                hasil = a / b;
                simbol = '÷';
            }

            document.getElementById('hasil').textContent =
                `Hasil: ${a} ${simbol} ${b} = ${hasil}`;
        }
    </script>
</body>

</html>