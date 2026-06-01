# Praktikum Pemrograman Web 1 - Pertemuan 5: CSS Implementation

## Identitas

- **Nama:** Nyoman Dimas Wira Bakti
- **Kelas:** B2

## Deskripsi Proyek

Proyek ini merupakan hasil _slicing_ antarmuka web. Halaman _landing page_ bertema "Hyrule Adventures" ini dibuat untuk mengimplementasikan tata letak visual, menghubungkan konsep desain visual dengan pengembangan sebuah web.

## Teknologi & Metodologi

- **Vanilla HTML5:** Dibangun menggunakan Semantic HTML (`<header>`, `<nav>`, `<section>`, `<figure>`, `<data>`, `<cite>`, `<footer>`) agar setiap elemen memiliki makna struktural yang tepat.
- **Vanilla CSS3:** Menggunakan CSS murni (tanpa _framework_ seperti Tailwind atau Bootstrap) dengan _reset_ CSS untuk konsistensi lintas _browser_.
- **BEM (Block, Element, Modifier):** Menggunakan cara penamaan _class_ CSS yang ketat (contoh: `.header`, `.header__nav`, `.header__nav-item--active`). Cara seperti ini memastikan kode CSS bersifat modular, tidak tumpang tindih, dan mudah di-_maintain_ saat proyek bertambah besar.

## Penyelesaian Tugas

Repositori ini memuat implementasi _styling_ teks yang diwajibkan dalam modul praktikum:

1. `text-indent`: Diterapkan pada `.hero__title` dan `.about__text` untuk memberikan lekukan awal pada teks.
2. `letter-spacing`: Diterapkan pada `.header__logo-text` dan `.hero__button` untuk mengatur kerapatan spasi antar huruf demi kebutuhan tipografi.
3. `word-spacing`: Diterapkan pada `.hero__description` dan `.header__dropdown-link` untuk mengatur jarak antar kata.
4. `line-height`: Diatur secara global pada `body` untuk _readability_, dan disesuaikan secara spesifik pada elemen _heading_ seperti `.hero__title`.
5. `white-space`: Diterapkan dengan nilai `nowrap` pada `.header__nav-link` agar teks navigasi tetap berada dalam satu baris dan tidak terpotong ke bawah.

## Struktur Direktori

```text
├── img/
│   └── castle-for-background.jpeg
├── index.html
├── style.css
└── README.md
```
