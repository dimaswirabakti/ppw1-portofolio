# Praktikum Pemrograman Web

## Cara Menjalankan

### 1. Clone & setup environment
```bash
git clone <url-repo>
cd praktikum-web
cp .env.example .env
# Edit .env sesuai kredensial kamu
```

### 2. Jalankan MySQL via Docker
```bash
docker compose up -d
```

### 3. Jalankan PHP built-in server
```bash
php -S localhost:8000 -t public/
```

### 4. Buka di browser
- Aplikasi : http://localhost:8000
- Adminer  : http://localhost:8081

Login Adminer:
- System   : MySQL
- Server   : mysql_database
- Username : ppw_user
- Password : (isi dari .env kamu)
- Database : ppw

## Struktur Branch Git
- `main`                  → kode final tiap pertemuan
- `pertemuan-XX-topik`    → pengerjaan per pertemuan