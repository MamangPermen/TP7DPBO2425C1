# TP7DPBO2425C1

Website ini bertema pengelolaan data pemain dan jadwal klub sepak bola **KING PERSIB Bandung**.  
Aplikasi dikembangkan menggunakan konsep **Object-Oriented Programming (OOP)** dengan struktur file modular, koneksi database berbasis **PDO**.

---

## 🤝🏻 Janji

Saya Nadhif Arva Anargya dengan NIM 2404336 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek. Untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

---

## 🎯 Tema Website

Tema yang digunakan adalah **manajemen data klub sepak bola PERSIB**, yang mencakup tiga aspek utama:
1. **Data Pemain** — berisi informasi detail setiap pemain seperti nama, posisi, nomor punggung, usia, dan asal.
2. **Jadwal Pertandingan** — mencatat tanggal, lawan, dan lokasi pertandingan.
3. **Statistik Pemain** — menampilkan rekap total performa pemain selama satu musim (penampilan, gol, assist, kartu kuning, kartu merah).

Fitur utama:
- CRUD (Create, Read, Update, Delete) untuk semua entitas.
- Pencarian pemain.

---

## 🧱 Struktur Database

Database bernama **`db_persib`** terdiri dari tiga tabel utama:

### 1️⃣ `pemain`
Menyimpan data utama setiap pemain.

| Kolom | Tipe Data | Keterangan |
|--------|------------|------------|
| `id_pemain` | INT (PK, AUTO_INCREMENT) | ID unik pemain |
| `nama` | VARCHAR(255) | Nama pemain |
| `posisi` | VARCHAR(255) | Posisi (GK, LB, RB, CB, CM, CAM, CDM, RW, LW, CF) |
| `no_punggung` | INT | Nomor punggung |
| `usia` | INT | Usia pemain |
| `asal` | VARCHAR(255) | Asal pemain |

---

### 2️⃣ `jadwal`
Menyimpan informasi pertandingan klub.

| Kolom | Tipe Data | Keterangan |
|--------|------------|------------|
| `id_jadwal` | INT (PK, AUTO_INCREMENT) | ID unik pertandingan |
| `tanggal` | DATE | Tanggal pertandingan |
| `lawan` | VARCHAR(255) | Nama tim lawan |
| `tempat` | VARCHAR(255) | Lokasi pertandingan |

---

### 3️⃣ `statistik`
Menyimpan data performa total pemain selama musim.

| Kolom | Tipe Data | Keterangan |
|--------|------------|------------|
| `id_stat` | INT (PK, AUTO_INCREMENT) | ID unik statistik |
| `id_pemain` | INT (FK → pemain.id_pemain) | Pemain yang direferensikan |
| `penampilan` | INT | Jumlah pertandingan dimainkan |
| `gol` | INT | Jumlah gol |
| `assist` | INT | Jumlah assist |
| `kartu_kuning` | INT | Jumlah kartu kuning |
| `kartu_merah` | INT | Jumlah kartu merah |

Relasi:  
- **pemain (1) → statistik (1)**  
- Jika pemain dihapus, datanya di tabel `statistik` ikut terhapus (`ON DELETE CASCADE`).

![alt text](https://github.com/MamangPermen/TP7DPBO2425C1/blob/main/Documentation/Capture.JPG)

---

## 🔄Alur & Penjelasan Program

### 🔸 1. Koneksi Database
File `config/db.php` membuat class `Database` menggunakan **PDO**:
- Menangani koneksi MySQL.
- Menyediakan atribut `ERRMODE_EXCEPTION`.
- Digunakan oleh semua class lain (`Pemain`, `Jadwal`, `Statistik`).

### 🔸 2. Class dan Fungsinya
#### 🧍‍♂️ `Pemain.php`
- CRUD lengkap (getAll, add, update, delete)
- Menggunakan **Prepared Statement**
- Menyediakan fitur pencarian pemain

#### 🗓️ `Jadwal.php`
- CRUD pertandingan
- Mengatur data tanggal, lawan, tempat

#### 📊 `Statistik.php`
- CRUD data performa total pemain
- Relasi langsung ke tabel `pemain`
- Fitur cari pemain di statistik

### 🔸 3. Tampilan (View)
- `view/player.php` → menampilkan tabel pemain + form tambah/edit.
- `view/match.php` → menampilkan tabel jadwal pertandingan.
- `view/stat.php` → menampilkan data statistik pemain.

### 🔸 4. Alur Program (`index.php`)
1. Inisialisasi class (`Pemain`, `Jadwal`, `Statistik`).
2. Menentukan halaman aktif berdasarkan `$_GET['page']`.
3. Menampilkan halaman default “Pemain” jika tidak ada parameter.
4. Setiap form di view akan memanggil fungsi class yang sesuai untuk CRUD.

---

## 📸 Dokumentasi


https://github.com/user-attachments/assets/420ee3e7-899c-4e57-ad41-a94f1d6f4a5f


